const gameBoard  = document.getElementById("gameBoard");
const htmlPlayer = document.getElementById("playerName");
const htmlScore = document.getElementById("score");
const htmlAttack = document.getElementById("attackNumber");


let highScore    = 0;
let score        = 0;

initGame();
function initGame(){
    console.log(score);
    
    for(let ant in jsonAnts) {
            if (jsonAnts.hasOwnProperty(ant)) {
                highScore += jsonAnts[ant].hp;
                drawAnt(ant);
            }
    }
    refreshGame();
}
function refreshGame(){
    document.getElementById("playerName").innerHTML =playerName;
    htmlAttack.innerHTML =attackNumber;
    htmlScore.innerHTML =score;
}

function drawAnt(ant) {
    gameBoard.innerHTML += '<div id="'+ant+'" class="ant"'+
    'style=" left:'+jsonAnts[ant].positionX+'px;'+
    'top:'+jsonAnts[ant].positionY+'px;"'+
    '"> <div class="hp">' + jsonAnts[ant].hp+'</div>'+
    '<img src="public/img/'+jsonAnts[ant].asset+'" > </div>';
}   

function attack(posx,posy){
    drawAttack(posx, posy);
    console.log('attack on X' +posx + ' Y'+posy);
    for(let ant in jsonAnts) {
        if(jsonAnts[ant].positionX >= posx-25
        && jsonAnts[ant].positionX <= posx+25
        && jsonAnts[ant].positionY >= posy-25
        && jsonAnts[ant].positionY <= posy+25
        ){
            takeDamage(jsonAnts[ant]);
        } 
    }
}

function drawAttack(posx, posy) {
    let div = document.createElement('div');
    div.className = 'attack';
    div.style.left =posx+'px';
    div.style.top =posy+'px';
    gameBoard.appendChild(div);
    setTimeout(() => { div.remove(); }, 500);


}   

function takeDamage(ant){
    ant.hp-=ant.takeDamage;
    console.log(document.getElementById(ant.name));
    console.log(document.getElementById(jsonAnts[ant.name].name));
    // TODO :  Bug: Ants' health points doesn't refresh. Dunno why.
    // console.log(document.getElementById(ant.name).getElementsByClassName('hp'));
    let targetDiv = document.getElementById(ant.name).getElementsByClassName('hp');
    targetDiv.innerHTML = ant.hp ;
    score += ant.takeDamage;
    refreshGame();
    if(ant.hp <= 0){
        deathAnt(ant);
    }
}

function deathAnt(ant){
    document.getElementById(ant.name).style.display = 'none';
    if(ant.name ==='queen0'){
        for (let el of document.querySelectorAll('.ant')) el.style.display = 'none';
        endGame();
    }
}

function endGame(){
    for(let ant in jsonAnts) {
        score += jsonAnts[ant].hp;
    }
    for (let el of document.querySelectorAll('.gameFinished')) el.style.display = 'block';
    document.getElementById('perfectAttack').style.display='none';
    document.getElementById('attack').style.display='none';
}

document.getElementById("attack").addEventListener("click", function(){ 
    let posx = Math.floor(Math.random() * 750) + 10 ;
    let posy = Math.floor(Math.random() * 550) + 10 ;
    attack(posx, posy);
    --attackNumber;
    refreshGame();
});

document.getElementById("perfectAttack").addEventListener("click", function(){ 
    const posxPefect = jsonAnts['queen0'].positionX;
    const posyPefect = jsonAnts['queen0'].positionY;
    attack(posxPefect, posyPefect);
    --attackNumber;
    refreshGame();
});

document.getElementById("restart").addEventListener("click", function(){ 
    window.location.href = "index.php";
});

document.getElementById("saveScore").addEventListener("click", function(){ 
    postAjax('saveScore.php', 'score='+score+'&name='+playerName,  function(saveResult){
        console.log(saveResult);
        if( saveResult == 'true'){
            alert('votre score de '+ score +' est sauvegardé');
        }else{
            alert('Score pas assez élévé');
        } 
    })
});



function postAjax(url, data, success) {
    var params = typeof data == 'string' ? data : Object.keys(data).map(
            function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
        ).join('&');

    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    return xhr;
}
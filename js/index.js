var widthTela = window.innerWidth;
const produtos = document.getElementById('produtos');
var count = 0;

if(produtos){
    var widthBoxCard = document.querySelector('.box-card').clientWidth;
    var widthVitrine = document.querySelector('.tela-produtos').clientWidth;
    var clicks = 0;
    var vitrine;
    var maxBoxItems = produtos.children.length;
    var startX = 0;
    var endX = 0;

    if(widthVitrine <= 450){
       vitrine = 1;
    }else if(widthVitrine > 450 && widthVitrine <= 1150){
        vitrine = 2;
    }else{
        vitrine = 3;
    }

    produtos.addEventListener('touchstart', (e)=>{
        startX = e.touches[0].clientX;
    });

    produtos.addEventListener('touchend', (e)=>{
        endX = e.changedTouches[0].clientX;
        pegaDedo();
    });

    function pegaDedo(){
        const dedo = startX - endX;


        if(Math.abs(dedo) > 100){
            if(dedo > 0){
                next();
            }else{
                prev();
            }
        }
    }

}



function next(){
    console.log(clicks);
    if(clicks == 0){
        clicks++;

        produtos.style.transform = `translateX(${-clicks * (widthBoxCard + 50)}px)`;
        produtos.style.transition = '1s all';

    }else if(clicks >= 1 && clicks < (maxBoxItems - vitrine)){
        clicks++;

        produtos.style.transform = `translateX(${-clicks * (widthBoxCard + 50)}px)`;
        produtos.style.transition = '1s all';

    }else{
        clicks = 0;
        produtos.style.transform = `translateX(0px)`;
    }
}

function prev(){
    if(clicks == 0){
        clicks = (maxBoxItems - vitrine);


        produtos.style.transform = `translateX(-${(clicks) * (widthBoxCard + 50)}px)`;
        produtos.style.transition = '1s all';

    }else if(clicks == maxBoxItems){
        clicks = maxBoxItems;
        
        clicks--;

        produtos.style.transform = `translateX(-${clicks * (widthBoxCard + 50)}px)`;
        produtos.style.transition = '1s all';

    }else if(clicks > 0 && clicks <= (maxBoxItems)){
        
        clicks--;

        produtos.style.transform = `translateX(-${clicks * (widthBoxCard + 50)}px)`;
        produtos.style.transition = '1s all';
    } else{
        clicks = 0;

        produtos.style.transform = `translateX(${maxBoxItems *  widthBoxCard}px))`;
    }
}


function menu(){
    if(widthTela <= 600){
        const btnMenu = document.getElementById('btnMenu');
        const menu = document.getElementById('menu');
        const listaMenu = document.getElementById('listaMenu');

        if(count == 0){
            count = 1;
            menu.style.width = '100%';
            menu.style.padding = '50px 20px';
            menu.style.transition = '2s';
            listaMenu.style.display = 'flex';
            trocarBtn(count);
        }else if(count == 1){
            count = 0;
            menu.style.width = '0';
            menu.style.padding = '0px 0px';
            menu.style.transition = '2s';
            trocarBtn(count);
            // listaMenu.style.display = 'none';
        }
    }else{
        return;
    }
}

function trocarBtn(count){
    if(count == 1){
        btnMenu.src = '/public/imgs/icons/x.png';
    }else{
        btnMenu.src = '/public/imgs/icons/arrow-right.png';
    }
}
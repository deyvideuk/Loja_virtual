const produtos = document.getElementById('produtos');
var count = 0;

if(produtos){
    var widthBoxCard = document.querySelector('.box-card').clientWidth;
    var widthProduto = document.querySelector('.tela-produtos').clientWidth;
    let clicks = 0;
    let maxBoxItems = produtos.children.length;

    function next(){
        if(clicks == 0){
            clicks++;

            let clickN = document.getElementById('clicks');
            let qtdItens = document.getElementById('maxBox');
            let widthItem = document.getElementById('widthBox');

            clickN.innerHTML = clicks;
            qtdItens.innerHTML = maxBoxItems;
            widthItem.innerHTML = widthBoxCard;

            produtos.style.transform = `translateX(${-clicks * (widthBoxCard)}px)`;
            produtos.style.transition = '1s all';

        }else if(clicks >= 1 && clicks < (maxBoxItems - 3)){
            clicks++;

            let clickN = document.getElementById('clicks');
            let qtdItens = document.getElementById('maxBox');
            let widthItem = document.getElementById('widthBox');

            clickN.innerHTML = clicks;
            qtdItens.innerHTML = maxBoxItems;
            widthItem.innerHTML = widthBoxCard;


            produtos.style.transform = `translateX(${-clicks * (widthBoxCard + 50)}px)`;
            produtos.style.transition = '1s all';

        }else{
            clicks = 0;

            let clickN = document.getElementById('clicks');
            let qtdItens = document.getElementById('maxBox');
            let widthItem = document.getElementById('widthBox');

            clickN.innerHTML = 0;
            qtdItens.innerHTML = 0;
            widthItem.innerHTML = 0;

            produtos.style.transform = `translateX(0px)`;
        }
        atualizar(quantidadeClicks + 1);
    }

    function prev(){
        if(clicks == 0){
            clicks = (maxBoxItems);

            let clickN = document.getElementById('clicks');
            let qtdItens = document.getElementById('maxBox');
            let widthItem = document.getElementById('widthBox');

            clickN.innerHTML = clicks;
            qtdItens.innerHTML = maxBoxItems;
            widthItem.innerHTML = widthBoxCard;


            produtos.style.transform = `translateX(-${(clicks/2) * (widthBoxCard + 50)}px)`;
            produtos.style.transition = '1s all';

        }else if(clicks == maxBoxItems){
            clicks = maxBoxItems/2;
            let clickN = document.getElementById('clicks');
            let qtdItens = document.getElementById('maxBox');
            let widthItem = document.getElementById('widthBox');
            
            clicks--;

            clickN.innerHTML = clicks;
            qtdItens.innerHTML = maxBoxItems;
            widthItem.innerHTML = widthBoxCard;

            produtos.style.transform = `translateX(-${clicks * (widthBoxCard + 50)}px)`;
            produtos.style.transition = '1s all';

        }else if(clicks > 0 && clicks <= (maxBoxItems)){
            let clickN = document.getElementById('clicks');
            let qtdItens = document.getElementById('maxBox');
            let widthItem = document.getElementById('widthBox');
            
            clicks--;

            clickN.innerHTML = clicks;
            qtdItens.innerHTML = maxBoxItems;
            widthItem.innerHTML = widthBoxCard;

            produtos.style.transform = `translateX(-${clicks * (widthBoxCard + 50)}px)`;
            produtos.style.transition = '1s all';
        }else{
            clicks = 0;

            let clickN = document.getElementById('clicks');
            let qtdItens = document.getElementById('maxBox');
            let widthItem = document.getElementById('widthBox');

            clickN.innerHTML = 0;
            qtdItens.innerHTML = 0;
            widthItem.innerHTML = 0;

            produtos.style.transform = `translateX(${maxBoxItems *  widthBoxCard}px))`;
        }
    }
}


function menu(){
    const btnMenu = document.getElementById('btnMenu');
    const menu = document.getElementById('menu');
    const listaMenu = document.getElementById('listaMenu');

    if(count == 0){
        count = 1;
        menu.style.width = '100%';
        menu.style.padding = '50px 20px';
        menu.style.transition = '2s';
        listaMenu.style.display = 'flex';
    }else if(count == 1){
        count = 0;
        menu.style.width = '0';
        menu.style.padding = '0px 0px';
        menu.style.transition = '2s';
        // listaMenu.style.display = 'none';
    }

    
    

}
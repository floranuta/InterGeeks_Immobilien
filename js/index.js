function manageFavourites(event){
    event.preventDefault();

    let likeBtn=event.target.closest('.appartment-card').querySelector('.like-btn');
    let wohnungId=event.target.closest('.appartment-card').querySelector('.icon-submit-btn').dataset.WohnungId;
    

    fetch("index.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
    },
    body: JSON.stringify({ wohnungId: wohnungId }), 
})
        .then(response=>{
        if(response.ok){
            if(likeBtn.style.color==="orange"){
                console.log(likeBtn.style.color);
                likeBtn.style.color="red";
            }else{
                likeBtn.style.color="orange";
            }
            }else{
                throw new Error('Network response was not ok');
            }
        })
        .catch(error => {
        console.error('Error:', error);}
    )}
    function scrollImageStrip(event){
        event.preventDefault();
        
       
        let appartmentCard = event.target.closest('.appartment-card');
    
        let countScroll=parseInt(appartmentCard.dataset.scroll);
         
         
        let countScrollHtmlEl=appartmentCard.querySelector('.count-scroll');
        let imgInnerContainer=appartmentCard.querySelector('.img-inner-container');
        let imgQuantity=appartmentCard.querySelectorAll('img').length
        let maxScrolls=imgQuantity*100-100;
        console.log("Count scroll: ",countScroll );
    
        if((event.target.classList.contains('arrow-right')
        ||event.target.parentElement.classList.contains('arrow-right'))&&maxScrolls>countScroll){

        countScroll=100+countScroll;    
        imgInnerContainer.style.transform="translate(-"+countScroll+"%)"; 
        console.log("Count scroll: ",countScroll ); 
        countScrollHtmlEl.innerText=(countScroll/100)+1+"/"+imgQuantity;
        appartmentCard.dataset.scroll=countScroll.toString();
        }else if(0<countScroll&&(event.target.classList.contains('arrow-left')||event.target.parentElement.classList.contains('arrow-left'))){
            console.log(appartmentCard.dataset.scrollCount+"dataset");
            countScroll=countScroll-100;
        imgInnerContainer.style.transform="translate(-"+countScroll+"%)";
    }
    countScrollHtmlEl.innerText=(countScroll/100)+1+"/"+imgQuantity;
        appartmentCard.dataset.scroll=countScroll.toString();
        
    }


    
    function toggleDropdown(event){

        const parentDiv=event.target.parentElement;
        parentDiv.querySelector(".dropdown-content").classList.toggle("visible");
    }
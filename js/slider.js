//Nhấn nút chuyển slide
const rightbtn = document.querySelector('.fa-right-long');
const leftbtn = document.querySelector('.fa-left-long');
const maxIndex = document.querySelectorAll('.slider-content-top img')
let index=0;
rightbtn.addEventListener("click",function(){
    index= index+1;
    if(index > maxIndex.length-1){index=0} 
    document.querySelector(".slider-content-top").style.right = index * 100+"%"
    
})
leftbtn.addEventListener("click",function(){
    index= index-1;
    if(index<0){
        index=maxIndex.length-1
    }
    document.querySelector(".slider-content-top").style.right = index * 100+"%"

})
function autoColorClick(){
    index = index+1
    if(index>maxIndex.length-1) index=0
    document.querySelector(".slider-content-top").style.right = index*100+"%"
}setInterval(autoColorClick,5000)   
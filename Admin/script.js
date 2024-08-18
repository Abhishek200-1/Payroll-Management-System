const  form = document.querySelector("form"),
        nxtBtn = form.querySelector(".nxtBtn"),
        backBtn = form.querySelector(".BackBtn"),
        allInput = form.querySelectorAll(".first input");
        
nxtBtn = addEventListener("click", ()=> {
    allInput.forEach(input => {
        if(input.value != ""){
            form.classList.add('secActive');
        }else{
            form.classList.remove('secActive');
        }
    })
})

nxtBtn = addEventListener("click", ()=> form.classList.remove('secActive'));

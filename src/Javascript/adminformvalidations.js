function validateForm() {
    var isValid = true;
    var inputs = document.querySelectorAll('input[required], select[required]');
    inputs.forEach(function(input) {
        if (input.value === "" || input.value === "default") 
        {
            input.classList.add('invalid');
            input.nextElementSibling.style.display = 'block'; 
            isValid = false;
        } 
        else 
        {
            input.classList.remove('invalid');
            input.nextElementSibling.style.display = 'none';
        }

        if (input.name === "Phone_Number") 
        {
            var phonePattern = /^\d{10}$/;
            if (!phonePattern.test(input.value)) 
            {
                input.classList.add('invalid');
                input.nextElementSibling.style.display = 'block'; 
                isValid = false;
            }
        }

        if (input.name === "mail") 
        {
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(input.value)) 
            {
                input.classList.add('invalid');
                input.nextElementSibling.style.display = 'block'; 
                isValid = false;
            }
        }
    });
    return isValid;
}
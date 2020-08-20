const formHiddenClass = "form_visibility-hidden";

const pairLog = {
    btn: document.querySelector(".button_type-login"),
    form: document.forms.formLog
}

const pairReg = {
    btn: document.querySelector(".button_type-register"),
    form: document.forms.formReg
}

function hideForm({ btn, form }) {
    btn.disabled = false;
    form.classList.add(formHiddenClass);
}

function showForm({ btn, form }) {
    btn.disabled = true;
    form.classList.remove(formHiddenClass);
}

pairLog.btn.addEventListener('click', () => {
    showForm(pairLog);
    hideForm(pairReg);
})


pairReg.btn.addEventListener('click', () => {
    showForm(pairReg);
    hideForm(pairLog);
})



//____


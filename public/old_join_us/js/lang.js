var arabic = document.getElementById('ar_click'),
    english = document.getElementById('en_click'),
    ar_txt = document.querySelectorAll('#ar'),
    en_txt = document.querySelectorAll('#en'),
    nb_ar = ar_txt.length,
    nb_en = en_txt.length;

arabic.addEventListener('click', function() {
    langue(arabic,english);
    document.getElementById('wrapper').setAttribute("class", "rtl wrapper");
}, false);

english.addEventListener('click', function() {
    langue(english,arabic);
    document.getElementById('wrapper').setAttribute("class", "ltr wrapper");
}, false);

function langue(langueOn,langueOff){
    if (!langueOn.classList.contains('current_lang')) {
        langueOn.classList.toggle('current_lang');
        langueOff.classList.toggle('current_lang');
    }
    if(langueOn.innerHTML == 'ع'){
        afficher(ar_txt, nb_ar);
        cacher(en_txt, nb_en);
    }
    else if(langueOn.innerHTML == 'En'){
        afficher(en_txt, nb_en);
        cacher(ar_txt, nb_ar);
    }
}

function afficher(txt,nb){
    for(var i=0; i < nb; i++){
        txt[i].style.display = 'block';
    }
}
function cacher(txt,nb){
    for(var i=0; i < nb; i++){
        txt[i].style.display = 'none';
    }
}
function init(){
    langue(arabic,english);
}
init();
$("#add-image").click(function () { // Je recup le numéro des futurs champs que je vais créer
    const index = + $('#widget-counter').val();
    console.log(index);
    
    // Je récupère le protoype des entrées
    const tmpl = $('#annonce_images').data('prototype').replace(/__name__/g, index);
    
    // J'injecte le code au sein de la div
    $("#annonce_images").append(tmpl);
    
    $('#widget-counter').val(index + 1)
    
    // Gestion du boutton supprimer
    handleDeleteButtons();
    });
    
    function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function () {
    const target = this.dataset.target;
    console.log(target)
    $(target).remove();
    });
    }
    
    function updateCounter() {
    const count = + $("#annonce_images div.form-group").length;
    console.log(count);
    $('#widget-counter').val(count);
    
    
    }
    
    updateCounter();
    handleDeleteButtons();
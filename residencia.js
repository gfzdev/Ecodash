// Controle do Modal de Edição
function openEditModal(residenceData) {
    const modal = document.getElementById('editResidenceModal');
    
    // Preencher formulário com os dados da residência
    document.getElementById('residence-name').value = residenceData.name;
    document.getElementById('residence-members').value = residenceData.members;
    document.getElementById('residence-address').value = residenceData.address;
    document.getElementById('residence-neighborhood').value = residenceData.neighborhood;
    document.getElementById('residence-city').value = residenceData.city;
    document.getElementById('image-preview').src = residenceData.image;
    
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeEditModal() {
    document.getElementById('editResidenceModal').classList.remove('active');
    document.body.style.overflow = '';
}

// Event Listeners
document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', function() {
        const card = this.closest('.residence-card');
        const residenceData = {
            name: card.querySelector('h2').textContent,
            image: card.querySelector('.residence-image').style.backgroundImage
                .replace('url("','').replace('")',''),
            members: card.querySelector('.fa-users').parentNode.textContent.trim().split(' ')[0],
            address: card.querySelector('.fa-map-marker-alt').parentNode.textContent
                .split('-')[0].trim(),
            neighborhood: card.querySelector('.fa-map-marker-alt').parentNode.textContent
                .split('-')[1].trim(),
            city: 'Vitória' // Você pode ajustar isso conforme seus dados
        };
        openEditModal(residenceData);
    });
});

document.querySelector('.close-modal').addEventListener('click', closeEditModal);
document.querySelector('.btn-cancel').addEventListener('click', closeEditModal);

// Fechar ao clicar fora do modal
document.getElementById('editResidenceModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

// Preview da imagem ao selecionar
document.getElementById('residence-image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('image-preview').src = event.target.result;
        };
        reader.readAsDataURL(file);
    }
});

// Envio do formulário
document.querySelector('.edit-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Aqui você pode adicionar a lógica para salvar as alterações
    alert('Alterações salvas com sucesso!');
    closeEditModal();
    
    // Atualizar a interface com os novos dados
    // ...
});
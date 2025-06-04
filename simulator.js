document.addEventListener('DOMContentLoaded', function() {
    // Simulator Step Navigation
    const nextButtons = document.querySelectorAll('.next-step');
    const prevButtons = document.querySelectorAll('.prev-step');
    
    nextButtons.forEach(button => {
        button.addEventListener('click', function() {
            const nextStep = this.getAttribute('data-next');
            navigateToStep(nextStep);
        });
    });
    
    prevButtons.forEach(button => {
        button.addEventListener('click', function() {
            const prevStep = this.getAttribute('data-prev');
            navigateToStep(prevStep);
        });
    });
    
    function navigateToStep(stepId) {
        // Hide all steps
        document.querySelectorAll('.simulator-step').forEach(step => {
            step.classList.remove('active');
        });
        
        // Show target step
        document.getElementById(stepId).classList.add('active');
        
        // Update step indicators
        document.querySelectorAll('.step').forEach(step => {
            step.classList.remove('active');
        });
        
        if (stepId === 'step1') {
            document.querySelectorAll('.step')[0].classList.add('active');
        } else if (stepId === 'step2') {
            document.querySelectorAll('.step')[1].classList.add('active');
        } else if (stepId === 'step3') {
            document.querySelectorAll('.step')[2].classList.add('active');
            initializeSimulationChart();
        }
    }
    
    // Initialize Simulation Chart
    function initializeSimulationChart() {
        const ctx = document.getElementById('simulationChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [
                    {
                        label: 'Consumo sem Painéis',
                        data: [450, 420, 400, 380, 350, 320, 330, 340, 360, 380, 400],
                        backgroundColor: 'rgba(78, 115, 223, 0.5)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Consumo com Painéis',
                        data: [90, 85, 80, 75, 70, 65, 65, 70, 75, 80, 85],
                        backgroundColor: 'rgba(28, 200, 138, 0.5)',
                        borderColor: 'rgba(28, 200, 138, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Projeção de Economia Mensal',
                        font: {
                            size: 16
                        }
                    },
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Consumo (kWh)'
                        }
                    }
                }
            }
        });
    }
});

function toggleCardExpansion(header) {
    const card = header.closest('.suggestions-card');
    card.classList.toggle('expanded');
    
    // Bloquear scroll da página quando expandido
    document.body.style.overflow = card.classList.contains('expanded') ? 'hidden' : '';
}

function toggleCardExpansion(header) {
    const card = header.closest('.suggestions-card');
    card.classList.toggle('expanded');
    
    // Bloquear scroll da página quando expandido
    document.body.style.overflow = card.classList.contains('expanded') ? 'hidden' : '';
}

function toggleSuggestion(header) {
    const suggestionItem = header.closest('.suggestion-item');
    suggestionItem.classList.toggle('active');
    
    // Fecha outras sugestões se necessário
    document.querySelectorAll('.suggestion-item').forEach(item => {
        if (item !== suggestionItem && item.classList.contains('active')) {
            item.classList.remove('active');
        }
    });
}

// Fechar ao clicar no botão X
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('close-expanded')) {
        const card = e.target.closest('.suggestions-card');
        card.classList.remove('expanded');
        document.body.style.overflow = '';
        
        // Fecha todas as sugestões ao fechar o card
        document.querySelectorAll('.suggestion-item').forEach(item => {
            item.classList.remove('active');
        });
    }
});

// Controle do Modal
function openNewRecordModal() {
    document.getElementById('newRecordModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('newRecordModal').classList.remove('active');
    document.body.style.overflow = '';
}

// Event Listeners
document.querySelector('.btn-primary').addEventListener('click', openNewRecordModal);
document.querySelector('.close-modal').addEventListener('click', closeModal);
document.querySelector('.btn-cancel').addEventListener('click', closeModal);

// Fechar ao clicar fora do conteúdo
document.getElementById('newRecordModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
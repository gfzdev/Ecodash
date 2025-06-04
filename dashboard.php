<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECODASH - Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="logoEcodash.png" alt="ECODASH Icon">

            </div>

            <nav class="sidebar-nav">
                <ul>
                    <li class="active"><a href="dashboard.html"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="simulador.html"><i class="fas fa-solar-panel"></i> Simulador Solar</a></li>
                    <li><a href="#"><i class="fas fa-chart-line"></i> Histórico</a></li>
                    <li><a href="#"><i class="fas fa-cog"></i> Configurações</a></li>
                    <li><a href="residencias.html"><i class="fa-solid fa-house"></i>Trocar residência</a></li>
                </ul>


                <div class="sidebar-footer">
                    <div class="user-profile">
                        <button>
                            <img src="user.jpg" alt="User Avatar">
                        </button>
                        <div class="user-info">
                            <span class="user-name"><?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
                            <span class="user-email"><?= htmlspecialchars($_SESSION['usuario_email']) ?></span>
                        </div>
                    </div>

                    <a href="logout.php" class="logout-btn" title="Sair"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <h1>Dashboard</h1>
                <div class="header-actions">
                    <div class="date-filter">
                        <i class="fas fa-calendar-alt"></i>
                        <select id="period-filter">
                            <option value="month" selected>Este Mês</option>
                            <option value="year">Este Ano</option>
                        </select>
                    </div>
                    <button class="btn-primary"><i class="fas fa-plus"></i> Novo Registro</button>
                </div>
            </header>

            <div class="dashboard-grid">
                <!-- Card 1: Consumo Atual -->
                <div class="card">
                    <div class="card-header">
                        <h3>Consumo Atual</h3>
                        <span class="badge success">-12% vs mês passado</span>
                    </div>
                    <div class="card-body">
                        <div class="consumo-info">
                            <span class="consumo-value">325</span>
                            <span class="consumo-unit">kWh</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 65%;"></div>
                        </div>
                        <div class="consumo-meta">
                            <span>Meta: 500 kWh</span>
                            <span>65% da meta</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Custo Atual -->
                <div class="card">
                    <div class="card-header">
                        <h3>Custo Atual</h3>
                    </div>
                    <div class="card-body">
                        <div class="custo-info">
                            <span class="custo-value">R$ 287,50</span>
                            <span class="custo-period">este mês</span>
                        </div>
                        <div class="chart-placeholder">
                            <canvas id="custoChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Sugestões -->
                <div class="suggestions-card">
                    <div class="card-header" onclick="toggleCardExpansion(this)">
                        <h3>Sugestões para Economizar Energia</h3>
                    </div>

                    <div class="card-body">
                        <div class="suggestions-list">
                            <!-- Dica 1 -->
                            <div class="suggestion-item">
                                <div class="suggestion-header" onclick="toggleSuggestion(this)">
                                    <i class="fas fa-lightbulb"></i>
                                    <div class="suggestion-title">Troque lâmpadas incandescentes</div>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="suggestion-content">
                                    <p>Substitua por lâmpadas LED que consomem até 80% menos energia e duram 25 vezes
                                        mais.</p>
                                    <div class="suggestion-meta">
                                        <span class="economy-badge">Economia: 15%</span>
                                        <span class="priority high">Prioridade: Alta</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Dica 2 -->
                            <div class="suggestion-item">
                                <div class="suggestion-header" onclick="toggleSuggestion(this)">
                                    <i class="fas fa-snowflake"></i>
                                    <div class="suggestion-title">Ajuste o ar-condicionado</div>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="suggestion-content">
                                    <p>Mantenha a temperatura em 23°C. Cada grau abaixo disso aumenta o consumo em 7%.
                                    </p>
                                    <div class="suggestion-meta">
                                        <span class="economy-badge">Economia: 10%</span>
                                        <span class="priority medium">Prioridade: Média</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Dica 3 -->
                            <div class="suggestion-item">
                                <div class="suggestion-header" onclick="toggleSuggestion(this)">
                                    <i class="fas fa-plug"></i>
                                    <div class="suggestion-title">Desligue aparelhos em standby</div>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="suggestion-content">
                                    <p>Use réguas com botão on/off para eliminar completamente o consumo fantasmas.</p>
                                    <div class="suggestion-meta">
                                        <span class="economy-badge">Economia: 5%</span>
                                        <span class="priority medium">Prioridade: Média</span>
                                    </div>
                                </div>
                            </div>

                            <div class="suggestion-item">
                                <div class="suggestion-header" onclick="toggleSuggestion(this)">
                                    <i class="fas fa-plug"></i>
                                    <div class="suggestion-title">Desligue aparelhos em standby</div>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="suggestion-content">
                                    <p>Use réguas com botão on/off para eliminar completamente o consumo fantasmas.</p>
                                    <div class="suggestion-meta">
                                        <span class="economy-badge">Economia: 5%</span>
                                        <span class="priority medium">Prioridade: Média</span>
                                    </div>
                                </div>
                            </div>

                            <div class="suggestion-item">
                                <div class="suggestion-header" onclick="toggleSuggestion(this)">
                                    <i class="fas fa-plug"></i>
                                    <div class="suggestion-title">Desligue aparelhos em standby</div>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="suggestion-content">
                                    <p>Use réguas com botão on/off para eliminar completamente o consumo fantasmas.</p>
                                    <div class="suggestion-meta">
                                        <span class="economy-badge">Economia: 5%</span>
                                        <span class="priority medium">Prioridade: Média</span>
                                    </div>
                                </div>
                            </div>

                            <div class="suggestion-item">
                                <div class="suggestion-header" onclick="toggleSuggestion(this)">
                                    <i class="fas fa-plug"></i>
                                    <div class="suggestion-title">Desligue aparelhos em standby</div>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="suggestion-content">
                                    <p>Use réguas com botão on/off para eliminar completamente o consumo fantasmas.</p>
                                    <div class="suggestion-meta">
                                        <span class="economy-badge">Economia: 5%</span>
                                        <span class="priority medium">Prioridade: Média</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="close-expanded">&times;</button>
                        <!-- Adicione mais 9 dicas seguindo o mesmo padrão -->
                    </div>
                </div>



                <!-- Card 4: Gráfico de Consumo -->
                <div class="card wide-card">
                    <div class="card-header">
                        <h3>Histórico de Consumo</h3>
                        <div class="chart-actions">
                            <button class="btn-chart active">Mês</button>
                            <button class="btn-chart">Ano</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="consumo-chart">
                            <canvas id="consumoChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Card 6: Simulação Solar -->
                <div class="card solar-card">
                    <div class="card-header">
                        <h3>Simulação Solar</h3>
                    </div>
                    <div class="card-body">
                        <div class="solar-info">
                            <i class="fas fa-solar-panel"></i>
                            <p>Você pode economizar até <strong>R$ 1.200/ano</strong> com painéis solares</p>
                        </div>
                        <button class="btn-secondary"><i class="fas fa-calculator"></i> Simular Agora</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Novo Registro de consumo -->
    <div class="expanded-modal" id="newRecordModal">
        <div class="modal-content">
            <button class="close-modal">&times;</button>
            <h2><i class="fas fa-plus-circle"></i> Novo Registro de Consumo</h2>

            <form class="record-form" action="processar_registro_energia.php" method="POST">
                <div class="modal-body">
                    <div class="form-section">
                        <div class="form-group">
                            <label for="record-date">Data do Registro</label>
                            <input type="date" id="record-date" name="data_leitura" required>
                        </div>

                        <div class="form-group">
                            <label for="energy-consumed">Consumo (kWh)</label>
                            <input type="number" id="energy-consumed" name="consumo_kwh" step="0.01" min="1" required>
                        </div>

                        <div class="form-group">
                            <label for="energy-cost">Custo (R$)</label>
                            <input type="number" id="energy-cost" name="custo_reais" step="0.01" min="1" required>
                        </div>

                        <div class="form-group">
                            <label for="notes">Observações</label>
                            <textarea id="notes" name="observacoes" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-cancel">Cancelar</button>
                    <button type="submit" class="btn-submit">Salvar Registro</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="simulator.js"></script>
</body>

</html>
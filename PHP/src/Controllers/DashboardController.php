<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\CategoriaModel;

class DashboardController
{
    private DashboardModel $dashboardModel;
    private CategoriaModel $categoriaModel;

    public function __construct() {
        $this->dashboardModel = new DashboardModel();
        $this->categoriaModel = new CategoriaModel();
    }

    public function exibirDashboard() {
        $receitaTotal = $this->dashboardModel->calcularReceitas();
        $despesaTotal = $this->dashboardModel->calcularDespesas();
        $maiorReceita = $this->dashboardModel->maiorReceita();
        $maiorDespesa = $this->dashboardModel->maiorDespesa();
        $saldoTotal = $receitaTotal - $despesaTotal;
        $ultimasReceitas = $this->dashboardModel->ultimasReceitas();
        $ultimasDespesas = $this->dashboardModel->ultimasDespesas();

        require __DIR__ . '/../View/Dashboard.php';
    }
}
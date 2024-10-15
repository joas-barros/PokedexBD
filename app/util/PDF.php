<?php 

require('fpdf/fpdf.php');
require_once('app/connection/DBConnection.php');

class PDF{
    private FPDF $pdf;
    private PDO $pdo;

    public static function generateAdmLogPDF(){
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdo = DBConnection::getInstance()->getConnection();

        $sql = "SELECT * FROM ADMIN_LOG";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 20);
        
        $pdf->Cell(190, 10, 'Arquivo de Log', 0, 1, 'C');

        // informacoes do log, ela possui 4 colunas (ID, Operacao, Nome da tabela e data de captura)
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 10, 'ID', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Operacao', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Nome da Tabela', 1, 0, 'C');
        $pdf->Cell(80, 10, 'Data de Captura', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 12);
        foreach($result as $row){
            $pdf->Cell(10, 10, $row['id'], 1, 0, 'C');
            $pdf->Cell(50, 10, $row['operacao'], 1, 0, 'C');
            $pdf->Cell(50, 10, $row['nome_tabela'], 1, 0, 'C');
            $pdf->Cell(80, 10, $row['data_captura'], 1, 1, 'C');
        }

        $pdf->Output();
    }

    public static function generateCapturadosLogPDF(){
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdo = DBConnection::getInstance()->getConnection();

        $sql = "SELECT * FROM CAPTURADOS_LOG";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 20);
        
        $pdf->Cell(190, 10, 'Captura Log', 0, 1, 'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(30, 10, 'Treinador', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Pokemon', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Data de Captura', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Hora de Captura', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 12);
        foreach($result as $row){
            $pdf->Cell(30, 10, $row['treinador_nome'], 1, 0, 'C');
            $pdf->Cell(50, 10, $row['pokemon_nome'], 1, 0, 'C');
            $pdf->Cell(50, 10, $row['data_captura'], 1, 0, 'C');
            $pdf->Cell(60, 10, $row['hora_captura'], 1, 1, 'C');
        }

        $pdf->Output();
    }
}

?>
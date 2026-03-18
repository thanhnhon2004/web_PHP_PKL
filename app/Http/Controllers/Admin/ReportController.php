<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Xuất báo cáo Word
     */
    public function export()
    {
        // Lấy dữ liệu báo cáo
        $monthlyData = $this->reportService->getMonthlyRevenueReport();
        $topProducts = $this->reportService->getTopSellingProducts();
        $summary = $this->reportService->getSummaryReport();

        // Tạo document Word
        $phpWord = new PhpWord();

        // Thiết lập margin
        $section = $phpWord->addSection([
            'marginTop' => 1000,
            'marginBottom' => 1000,
            'marginLeft' => 1000,
            'marginRight' => 1000,
        ]);

        // Tiêu đề
        $section->addText(
            'BÁO CÁO DOANH THU KINH DOANH',
            ['name' => 'Times New Roman', 'size' => 16, 'bold' => true],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
        );

        $section->addText(
            'CAMERA MAN STORE',
            ['name' => 'Times New Roman', 'size' => 14, 'bold' => true],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
        );

        $section->addText(
            'Ngày lập: ' . $summary['generatedAt'],
            ['name' => 'Times New Roman', 'size' => 11],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
        );

        $section->addTextBreak();

        // === PHẦN I: THÔNG TIN TÓM TẮT ===
        $section->addText(
            'I. THÔNG TIN TÓM TẮT',
            ['name' => 'Times New Roman', 'size' => 13, 'bold' => true]
        );

        $table = $section->addTable(['borderSize' => 6, 'borderColor' => '000000']);
        $table->addRow();
        $table->addCell(3000)->addText('Chỉ tiêu', ['bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $table->addCell(3000)->addText('Giá trị', ['bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

        $this->addTableRow($table, 'Tổng doanh thu', number_format($summary['totalRevenue'], 0, ',', '.') . ' VNĐ');
        $this->addTableRow($table, 'Tổng đơn hàng hoàn thành', $summary['totalOrders'] . ' đơn');
        $this->addTableRow($table, 'Doanh thu tháng hiện tại', number_format($summary['currentMonthRevenue'], 0, ',', '.') . ' VNĐ');
        $this->addTableRow($table, 'Doanh thu tháng trước', number_format($summary['lastMonthRevenue'], 0, ',', '.') . ' VNĐ');
        $this->addTableRow($table, 'Tăng trưởng', ($summary['revenueGrowth'] > 0 ? '+' : '') . number_format($summary['revenueGrowth'], 2) . '%');

        $section->addTextBreak(2);

        // === PHẦN II: DOANH THU THEO THÁNG ===
        $section->addText(
            'II. DOANH THU THEO THÁNG (12 THÁNG GẦN NHẤT)',
            ['name' => 'Times New Roman', 'size' => 13, 'bold' => true]
        );

        $table = $section->addTable(['borderSize' => 6, 'borderColor' => '000000']);
        $table->addRow();
        $table->addCell(2000)->addText('Tháng', ['bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $table->addCell(2500)->addText('Doanh thu (VNĐ)', ['bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $table->addCell(1500)->addText('Số đơn', ['bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

        for ($i = 0; $i < count($monthlyData['months']); $i++) {
            $table->addRow();
            $table->addCell(2000)->addText($monthlyData['months'][$i], [], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(2500)->addText(number_format($monthlyData['revenues'][$i], 0, ',', '.'), [], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT]);
            $table->addCell(1500)->addText($monthlyData['orderCounts'][$i], [], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        }

        $section->addTextBreak(2);

        // === PHẦN III: SẢN PHẨM BÁN CHẠY ===
        $section->addText(
            'III. TOP 10 SẢN PHẨM BÁN CHẠY',
            ['name' => 'Times New Roman', 'size' => 13, 'bold' => true]
        );

        $table = $section->addTable(['borderSize' => 6, 'borderColor' => '000000']);
        $table->addRow();
        $table->addCell(500)->addText('STT', ['bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $table->addCell(3000)->addText('Tên sản phẩm', ['bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $table->addCell(1200)->addText('Số lượng bán', ['bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $table->addCell(2000)->addText('Doanh thu (VNĐ)', ['bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

        foreach ($topProducts as $key => $product) {
            $table->addRow();
            $table->addCell(500)->addText($key + 1, [], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(3000)->addText($product->name, []);
            $table->addCell(1200)->addText($product->total_sold, [], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(2000)->addText(number_format($product->total_revenue, 0, ',', '.'), [], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT]);
        }

        $section->addTextBreak(2);

        // Chân trang
        $section->addText(
            'Báo cáo này được tạo tự động bởi hệ thống quản lý',
            ['name' => 'Times New Roman', 'size' => 9, 'italic' => true],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
        );

        // Lưu file
        $fileName = 'Bao_cao_doanh_thu_' . now()->format('Y-m-d_H-i-s') . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'php');
        
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    /**
     * Thêm dòng vào bảng
     */
    private function addTableRow($table, $label, $value)
    {
        $table->addRow();
        $table->addCell(3000)->addText($label);
        $table->addCell(3000)->addText($value, [], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT]);
    }
}

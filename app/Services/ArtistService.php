<?php

namespace App\Services;

use App\Services\BaseService;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Http\Requests\Artist\ArtistStoreRequest;

class ArtistService extends BaseService
{
    protected $columns = [
        'id',
        'name',
        'dob',
        'gender',
        'address',
        'first_release_year',
        'no_of_album_released',
        'created_at',
        'updated_at'
    ];

    protected $table = 'artists';

    public function __construct()
    {
        parent::__construct(
            $this->table,
            $this->columns,
        );
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $char = ord('A');
        foreach ($this->visibleColumns as $column) {
            $sheet->setCellValue(chr($char) . '1', $column);
            $char++;
        }
        $columns = implode(', ', $this->visibleColumns);
        $artists = $this->sqlResult("SELECT $columns from $this->table", 2);

        $row = 2;
        foreach ($artists as $artist) {
            $char = ord('A');
            foreach ($this->visibleColumns as $column) {
                $sheet->setCellValue(chr($char) . $row, $artist[$column])->getColumnDimension(chr($char))->setAutoSize(true);
                $char++;
            }
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'artist.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($tempFile);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($tempFile));
        readfile($tempFile);
        unlink($tempFile);
        exit;
    }

    public function import($file)
    {
        $spreadsheet = IOFactory::load($file);
        $spreadsheet = $spreadsheet->getActiveSheet();
        $highestColumn = $spreadsheet->getHighestColumn();
        $highestRow = $spreadsheet->getHighestRow();
        for ($i = 2; $i <= $highestRow; $i++) {
            $data = [];
            for ($char = ord('A'); $char <= ord($highestColumn); $char++) {
                if ($spreadsheet->getCell(chr($char) . 1)->getValue() == 'id') {
                    continue;
                }
                $data[$spreadsheet->getCell(chr($char) . 1)->getValue()] = $spreadsheet->getCell(chr($char) . $i)->getValue();
            }
            $validator = Validator::make($data, (new ArtistStoreRequest())->rules());
            if ($validator->fails()) {
                return $validator;
            }
            $this->create($data);
        }
        return true;
    }
}

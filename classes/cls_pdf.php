<?php

require_once __DIR__ . '/../libraries/tcpdf/tcpdf.php';

class cls_pdf
{
    public function generateFromTemplate($templateName, $data, $fileName, $storageName, $saveMethod)
    {


        // Validate template exists
        $fullTemplatePath = realpath(__DIR__ . '/../presentation/template/pdfTemplate/' . $templateName);
        if (!file_exists($fullTemplatePath)) {
            throw new InvalidArgumentException("Template file not found: {$templateName}");
        }

        try {

            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetSubject('Private Health Services Regulatory Council');
            // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            // set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

            // set header and footer fonts
            $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


            $pdf->AddPage();
            extract($data);

            ob_start();
            include $fullTemplatePath;
            $html = ob_get_clean();

            $pdf->writeHTML($html);

            if ($fileName){
                $newFileName = $fileName . '.pdf';
            }else{
                $newFileName = 'null' . '.pdf';
            }


            if ($saveMethod === 'F') {
                $baseDir = __DIR__ . '/../drive/' . $storageName . '/';
                $storagePath = realpath(dirname($baseDir)) . '/' . basename($storageName);

                if (!file_exists($storagePath)) {
                    if (!mkdir($storagePath, 0755, true)) {
                        throw new RuntimeException("Failed to create directory: {$storagePath}");
                    }
                    chmod($storagePath, 0755);
                }

                $savePath = $storagePath . '/' . $newFileName;
                $pdf->Output($savePath, 'F');

                if (!file_exists($savePath)) {
                    throw new RuntimeException("Failed to save PDF to: {$savePath}");
                }
                return $savePath;
            } else if ($saveMethod === 'D') {
                $pdf->Output($newFileName, $saveMethod);
                return null;
            }


        } catch (Exception $e) {
            throw new RuntimeException("Failed to generate PDF: " . $e->getMessage());
        }
        return null;
    }
}
<?= $this->extend("app") ?>

<?= $this->section("page") ?>
<div class="page-content header-clear-medium">
    <div class="card overflow-scroll card-style">
        <div class="content mb-0">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <h4>Rekap Data - <?= date("d/m/Y H:i:s"); ?></h4>
                <button type="button" class="btn-full btn bg-fade2-yellow" onclick="exportTableToExcel('exportTable', '<?= $data['fileName'] ?>')">
                    <i class="bi bi-file-earmark-arrow-down-fill font-16 text-dark me-2"></i><span class="text-dark">Export</span>
                </button>
            </div>
            <div class="table-responsive mt-4">
                <table class="table color-theme mb-2" id="exportTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Order</th>
                            <th>Nama Pembeli</th>
                            <th>Nomor Pembeli</th>
                            <th>Alamat Pembeli</th>
                            <th>KTP Pembeli</th>
                            <th>KTP Penjamin</th>
                            <th>Unit</th>
                            <th>Kode Unit</th>
                            <th>Harga Unit</th>
                            <th>Tenor</th>
                            <th>Paket</th>
                            <th>Asuransi</th>
                            <th>Tanggal Survey</th>
                            <th>Surveyor</th>
                            <th>Lokasi Survey</th>
                            <th>Sales</th>
                            <th>Dealer</th>
                            <th>Tanggal Data Diajukan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php forEach($data['results'] as $key => $result): ?>
                            <tr>
                                <th><?= ($key++) + 1 ?></th>
                                <td><?= $result['uid'] ?></td>
                                <td><?= $result['name'] ?></td>
                                <td><?= $result['phoneNumber'] ?></td>
                                <td><?= $result['address'] ?></td>
                                <td>https://sarmtf.com/uploads/ktp/<?= $result['identity'][0] ?></td>
                                <td>https://sarmtf.com/uploads/ktp/<?= $result['identity'][1] ?></td>
                                <td><?= $result['unit'] ?></td>
                                <td><?= $result['unitCode'] ?></td>
                                <td><?= $result['price'] ?></td>
                                <td><?= $result['tenor'] ?></td>
                                <td><?= $result['package'] ?></td>
                                <td><?= $result['insurance'] ==  1 ? 'Ya' : 'Tidak' ?></td>
                                <td><?= $result['date'] ?></td>
                                <td><?= $result['surveyor'] ?></td>
                                <td><?= $result['location'] ?></td>
                                <td><?= $result['sales'] ?></td>
                                <td><?= $result['dealer'] ?></td>
                                <td><?= $result['dateSubmitted'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>

<?= $this->section("scripts") ?>
<script type="text/javascript">
    function exportTableToExcel(tableID, filename){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        
        // Specify file name
        filename = filename ? filename +'.xls':'<?= $data['fileName'] ?>.xls';
        
        // Create download link element
        downloadLink = document.createElement("a");
        
        document.body.appendChild(downloadLink);
        
        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        
            // Setting the file name
            downloadLink.download = filename;
            
            //triggering the function
            window.location = downloadLink;
        }
    }
</script>
<?= $this->endSection() ?>
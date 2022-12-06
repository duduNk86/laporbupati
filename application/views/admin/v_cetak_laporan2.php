<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Laporan Rekapitulasi Cetak</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/laporan/laporan.css')?>"/>
</head>
<body onload="window.print()">
<?php
$uri3=$this->uri->segment(3);
$uri4=$this->uri->segment(4);
?>
<div id="laporan">
<table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:1px;margin-bottom:20px;">
<!--<tr>
    <td><img src="<?php// echo base_url().'assets/img/kop_surat.png'?>"/></td>
</tr>-->
</table>

<table border="0" align="center" style="width:800px; border:none;margin-top:1px;margin-bottom:0px;">
<tr>
    <?php
        $id_admin=$this->session->userdata('idadmin');
        $q=$this->db->query("SELECT * FROM tbl_admin WHERE pengguna_id='$id_admin'");
        $c=$q->row_array();
        ?>
    <td colspan="2" style="width:800px;paddin-left:20px;"><center><h4>USULAN Aduan <?php echo strtoupper($c['pengguna_nama']);?></h4></center></td>
    <hr width="63%">


</tr>
                       
</table>
<hr width="63%">

<table border="0" align="center" style="width:900px;border:none;">
   <tr>
      <th style="text-align:left"></th>
   </tr>
</table>

<table id="cetak_laporan" border="1" align="center" style="width:900px;margin-bottom:20px;">
<thead>
    <tr>
        <th style="width:50px;">No</th>
         <th>NAMA</th>
        <th>KOMISI</th>
        <th>NAMA USULAN</th>
        <th>RINCIAN USULAN</th>
        <th>LOKASI</th>
<!--         <th>Tanggal</th> -->
        <th>ANGGARAN (Rp)</th>

    </tr>
</thead>
<tbody id="tbody_cetak_laporan">

</tbody>
<tfoot>
    <tr>

        <td colspan="6" style="text-align:center;"><b>Total</b></td>
        <td style="text-align:right;"><b><?php echo number_format($jml);?></b></td>

    </tr>
</tfoot>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td></td>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="center">Wonosobo, <?php echo date('d-M-Y')?></td>
    </tr>
    <tr>
        <td align="center"></td>
    </tr>
   
    <tr>
    <td><br/><br/><br/><br/></td>
    </tr>    
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="center">( <?php echo $this->session->userdata('nama');?> )</td>
    </tr>
    <tr>
        <td align="center"></td>
    </tr>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <th><br/><br/></th>
    </tr>
    <tr>
        <th align="left"></th>
    </tr>
</table>
</div>
<!--     <script>
        window.print();
    </script> -->
          <!-- jQuery 2.2.3 -->
      <script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
      <!-- Bootstrap 3.3.6 -->
      <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
      <!-- DataTables -->
      <script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
      <script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>
      <!-- SlimScroll -->
      <script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
      <!-- FastClick -->
      <script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
      <!-- AdminLTE App -->
      <script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
      <script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>
    <script> 


            tampil_cetak_komisi();
            function tampil_cetak_komisi(){
                  $.ajax({
                      type  : 'GET',
                      url  : "<?php echo base_url('admin/cetak/cetak_komisi_json/').$this->uri->segment(4);?>",
                      async : true,
                      dataType : 'json',
                      success : function(data){
                          var html = '';
                          var i;
                          var no=0;
                          for(i=0; i<data.length; i++){
                              var no = no+1;
                              html += '<tr>'+
                                    '<td style="text-align:center;">'+no+'</td>'+
                                      '<td style="width:600px;padding-left:5px;">'+data[i].ditujukan_kepada+'</td>'+
                                      '<td style="width:500px;padding-left:10px;">'+data[i].nama+'</td>'+
                                      '<td style="width:1500px;padding-left:10px;">'+data[i].judul_laporan+'</td>'+
                                      '<td style="width:2500px;">'+data[i].isi_laporan+'</td>'+
                                      '<td style="width:1000px;">'+data[i].lokasi+'</td>'+
                                      '<td style="text-align:right;width:400px;">'+number_format(data[i].anggaran)+'</td>'+

                                  '</tr>';
                          }
                              $('#tbody_cetak_laporan').html(html);
                              $('#tbody_cetak_laporan').refresh;
                                          
                            //   '<td class="project-actions" style="text-align:center;">'+
                    //   $('#tbody_cetak_laporan').DataTable({
                    //       "paging": true,
                    //       "lengthChange": true,
                    //       "searching": true,
                    //       "ordering": true,
                    //       "info": true,
                    //       "autoWidth": true
                    //       });
                      }

                  });
              }

      </script>
      <script>
      function number_format (number, decimals, decPoint, thousandsSep) { 
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
            var n = !isFinite(+number) ? 0 : +number
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
            var s = ''

            var toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
            }

            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
            if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
            }

            return s.join(dec)
        }
      </script>
</body>




</html>
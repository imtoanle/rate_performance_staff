<style type="text/css">
  table {
    font-family:"Times New Roman";
    mso-generic-font-family:auto;
    font-size: 13pt;
    white-space:nowrap;
  }
  table, table tr, table th, table td {
    border: 0.5px solid #000;
  }
  .uppercase { text-transform: uppercase; }
  .bold { font-weight: bold }
  .text-center { text-align: center }
</style>
<?php $firstVoteArray = array_values($voteByRole)[0]; ?>
<table style="border:none;">
  <tr style="border:none;">
    <td style="border:none;">CÔNG TY TNHH THƯƠNG MẠI KHATOCO</td>
    @for($i=0;$i<(count($voterArr[$firstVoteArray[0]->id])*3 + 1); $i++)
    <td style="border:none;"></td>
    @endfor
    <td style="border:none;"><center>Mẫu số: </center></td>
  </tr>
  
  <tr style="border:none;">
    <td style="border:none;"><b></b></td>
  </tr>
  
  <tr style="border:none;">
    <td style="border:none;" colspan="{{count($voterArr[$firstVoteArray[0]->id])*3 + 4}}" text-align="center"><center><b></b></center></td>
  </tr>
  <tr style="border:none;">
    <td style="border:none;" colspan="{{count($voterArr[$firstVoteArray[0]->id])*3 + 4}}"><center><b><i>Đối tượng đánh giá: </i></b></center></td>
  </tr>
  <tr></tr>
</table>

@include(Config::get('view.backend.report-details-child'))


<table style="border:none;">
  <tr style="border:none;">
    @for($i=0;$i<(count($voterArr[$firstVoteArray[0]->id])*3 + 2); $i++)
    <td style="border:none;"></td>
    @endfor
    <td style="border:none;"><center><i>Nha Trang, ngày {{date("d")}} tháng {{date("m")}} năm {{date("Y")}}</i> </center></td>
  </tr>
  <tr style="border:none;">
    @for($i=0;$i<(count($voterArr[$firstVoteArray[0]->id])*3 + 2); $i++)
    <td style="border:none;"></td>
    @endfor
    <td style="border:none;"><center><b>GIÁM ĐỐC</b></center></td>
  </tr>
</table>
<br /><br /><br />
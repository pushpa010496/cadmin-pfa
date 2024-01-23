<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html><head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Ochre Media</title>

</head>

<body>
  <table style="width: 100%; border-collapse: collapse; margin-top: 30px" align="left" border="1">
   <!--  <thead>
      <tr>
        <th colspan="3"  style="padding: 10px;background-color: #efa317;color:white">Banners Created</th>
      </tr>
    </thead> -->

    <tbody>    
      <tr>
        <th style="padding: 5px">Slider Title</th>
        <th style="padding: 5px">From Date</th>
        <th style="padding: 5px">To Date</th>
        <th style="padding: 5px">Track Url</th>
      </tr>
        <tr>
          <td  style="padding: 5px">{{$name }}</td>
          <td  style="padding: 5px">{{ date('d-m-Y', strtotime($from_date)) }}</td>
          <td  style="padding: 5px;color:#ff7800">{{  date('d-m-Y', strtotime($to_date))  }}</td>
           <td  style="padding: 5px">{{$track_url }}</td>
        </tr>    
    </tbody>
  </table>
</body></html>
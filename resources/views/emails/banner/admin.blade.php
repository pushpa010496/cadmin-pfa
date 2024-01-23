<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">



<html><head>



<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



<title>Ochre Media</title>



</head>



<body>

  <table style="width: 100%; border-collapse: collapse; margin-top: 30px" align="left" border="1">

    <?php

      if($type =='1'){

         $banner = 'Prime Banner - Above logo';

      }

      elseif($type =='2'){

        $banner = 'Sky Tower Banner';

      }

      elseif($type =='3'){

        $banner = 'Leader Board - Below Menu & Slider';

      }

      elseif($type =='4'){

        $banner = 'Top/Full - Below Slider & News';

      }

      elseif($type =='5'){

        $banner = 'Base Banner - Below Editorial Section';

      }

      elseif($type =='6'){

        $banner = 'Square Banner';

      }

      elseif($type =='7'){

        $banner = 'Middle Banner - Between News & PR';

      }

      elseif($type =='8'){

        $banner = 'Bottom One - Above KB';

      }

      elseif($type =='9'){

        $banner = 'Bottom Two - Between KB & AB';

      }

      elseif($type =='10'){

        $banner = 'Middle Banner Two - Between PR & Events';

     
      } elseif($type =='11'){

        $banner = 'Bottom - Below Events';
 
     }else{
       $banner = 'Logo/Menu Banner - Between Logo & Menu';
     }

    ?>

    <tbody>    

      <tr>

        <th style="padding: 5px">Banner Title</th>

        <th style="padding: 5px">From Date</th>

        <th style="padding: 5px">To Date</th>

        <th style="padding: 5px">Track Url</th>

        <th style="padding: 5px">Type</th>

        <th style="padding: 5px">Status</th>

      </tr>

        <tr>

          <td  style="padding: 5px">{{$name }}</td>

          <td  style="padding: 5px">{{ date('d-m-Y', strtotime($from_date)) }}</td>

          <td  style="padding: 5px;color:#ff7800">{{  date('d-m-Y', strtotime($to_date))  }}</td>

           <td  style="padding: 5px">{{$track_url }}</td>

            <td  style="padding: 5px">{{$banner}}</td>

            <td  style="padding: 5px">{{$status}}</td>

        </tr>    

    </tbody>

  </table>

</body></html>
//Bought ticket CSS
    C0{width:200px;border:dotted red    0px;display:block;float:left;font-size:16px;}
	/**/	C1{width:200px;border:dotted orange 0px;display:block;float:left;text-align:left;margin-left:15px;padding-top:5px;}
    C2{width:85px;border:dotted red     0px;display:block;float:left;text-align:right;}
    C3{width:40px;border:dotted red     0px;display:block;float:left;}
    C4{width:016px;border:dotted red    0px;display:block;float:left;}
	/**/	C5{width:132px;border:dotted blue   0px;display:block;float:left;text-align:right;}
    C6{width:200px;border:dotted red    0px;float:left;}
    C7{width:200px;border:dotted red    0px;display:block;float:right;text-align:right;}
    C8{width:300px;float:left;text-align:left;}
    C9{width:325px;float:right;text-align:right;display:block;margin-bottom:20px;}
    CZ{width:001px;height:0px;clear:both;display:block;}
    CX{width:250px;display:block;float:left;text-align:left;clear:both;margin-bottom:6px;}
    CXspan{font-size:20px;font-weight:bold;float:right}

//Select ticket table
.me_ul_as_table {
	/*//display:table;
	border-collapse: collapse;
	border-spacing: 0;
	width:100%;
	margin:0px;padding:0px;*/
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width:670px;
    border-collapse: collapse;
    border-spacing: 0;
    margin:0px;padding:0px;
}
.me_li_as_tr {
	display: table-row;
}
.me_ul_as_table .me_li_as_tr:nth-child(even){
    background-color:#F1F1F1  ;
}
.me_ul_as_table .me_li_as_tr:nth-child(odd){
    background-color:#FEFEFE;
}
.me_div_as_td
{
	/*display:table-cell;
    text-align:center;
	border: 1px solid #000000;
    vertical-align: middle;*/
    display:table-cell;
    border: 1px solid transparent; /* No more visible border */
    height: 30px;
    //transition: all 0.3s;  /* Simple transition for hover effect */
    text-align:center;
    vertical-align: middle;
}
.me_div_as_th
{
	/*background-color:gray;
	font-size:16px;
	font-weight:bold;
	display:table-row;
    //text-align:center;
	border: 1px solid #000000;
   // vertical-align: middle;*/
    display:table-row;
    background: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
    font-size:16px;
}
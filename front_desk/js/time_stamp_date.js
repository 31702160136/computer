/*	时间戳转日期
 * 
 **/
function getMyDate(str){
	//时间戳为十位数，*1000转换为13位
    var oDate = new Date(str*1000),  
    oYear = oDate.getFullYear(),  
    oMonth = oDate.getMonth()+1,  
    oDay = oDate.getDate(),  
    oTime = oYear +'-'+ getzf(oMonth) +'-'+ getzf(oDay);//最后拼接时间  
    return oTime;  
}; 
//补0操作
function getzf(num){  
    if(parseInt(num) < 10){
        num = '0'+num;  
    }  
	return num;  
}
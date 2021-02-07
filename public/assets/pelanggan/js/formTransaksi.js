function chooseTipePembayaran(element) 
{
    let blockValue = element.value == 0 ? 'none' : 'block';
    document.getElementById("tipe_pengambilan").style.display = blockValue;
}

function chooseTipePengambilan(element) 
{
    let blockValue = element.value == 0 ? 'none' : 'block';
    document.getElementById("data_antar").style.display = blockValue;
}

function getMinimunTanggalMulaiPesan() 
{
    let minDate = new Date();
    let dd = minDate.getDate()+3;
    let mm = minDate.getMonth()+1;
    let yyyy = minDate.getFullYear();
    if(dd<10) dd='0'+dd
    if(mm<10) mm='0'+mm
    minDate = yyyy+'-'+mm+'-'+dd;
    return minDate;
}

function getMinimumTangalAkhirPesan(tanggalMulaiPesan) 
{
    let minDate = new Date(tanggalMulaiPesan);
    let dd = minDate.getDate()+1;
    let mm = minDate.getMonth()+1;
    let yyyy = minDate.getFullYear();
    if(dd<10) dd='0'+dd
    if(mm<10) mm='0'+mm
    minDate = yyyy+'-'+mm+'-'+dd;
    return minDate;
}

function getMaximumTangalAkhirPesan(tanggalMulaiPesan) 
{
    let maxDate = new Date(tanggalMulaiPesan);
    let dd = maxDate.getDate();
    let mm = maxDate.getMonth()+2;
    let yyyy = maxDate.getFullYear();
    if(dd<10) dd='0'+dd
    if(mm<10) mm='0'+mm
    maxDate = yyyy+'-'+mm+'-'+dd;
    return maxDate;
}

function setMinDateMulaiPinjam() 
{
    let mulaiDatePinjamElement = document.getElementById("tanggal_mulai_peminjaman");
    let minDate = getMinimunTanggalMulaiPesan();
    mulaiDatePinjamElement.value = minDate;    
    mulaiDatePinjamElement.setAttribute('min', minDate);
}

function adjustDateAkhirPinjam() 
{
    let mulaiDatePinjamElement = document.getElementById("tanggal_mulai_peminjaman");
    let akhirDatePinjamElement = document.getElementById("tanggal_akhir_peminjaman");
    let minDate = getMinimumTangalAkhirPesan(mulaiDatePinjamElement.value);
    let maxDate = getMaximumTangalAkhirPesan(mulaiDatePinjamElement.value);
    akhirDatePinjamElement.value = minDate;    
    akhirDatePinjamElement.setAttribute('min', minDate);
    akhirDatePinjamElement.setAttribute('max', maxDate);
}
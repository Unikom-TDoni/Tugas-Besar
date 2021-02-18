function chooseTipePengambilan() 
{
    let element = document.getElementById("tipe_pengambilan");
    let blockValue = element.value == 0 ? 'none' : 'block';
    document.getElementById("data_antar").style.display = blockValue;
}

function initDate() 
{
    let mulaiDatePinjamElement = document.getElementById("tanggal_mulai_peminjaman");

    let minDateMulai = getMinimunTanggalMulaiPesan();
    let minDateAkhir = getMinimumTangalAkhirPesan(minDateMulai);
    let maxDateAkhir = getMaximumTangalAkhirPesan(minDateMulai);
    let day = changeAmmountDay(minDateMulai, minDateAkhir);


    mulaiDatePinjamElement.value = minDateMulai;   
    mulaiDatePinjamElement.setAttribute('min', minDateMulai);

    cahangeTotalPrize(day);
    changeReciptInfo(minDateMulai, minDateAkhir);
    changeAkhirDateValue(minDateAkhir, maxDateAkhir);
}

function onStartDateBookingChange() 
{
    let mulaiDatePinjamElement = document.getElementById("tanggal_mulai_peminjaman");

    let awalDate = mulaiDatePinjamElement.value;
    let minAkhirDate = getMinimumTangalAkhirPesan(awalDate);
    let maxAkhirDate = getMaximumTangalAkhirPesan(awalDate);
    let day = changeAmmountDay(awalDate, minAkhirDate);
    
    changeReciptInfo(awalDate,minAkhirDate);
    changeAkhirDateValue(minAkhirDate, maxAkhirDate);
    cahangeTotalPrize(day);
}

function onEndDateBookingChange() 
{
    let reciptInfoReturn = document.getElementById("recipt_info_return");
    let akhirDatePinjamElement = document.getElementById("tanggal_akhir_peminjaman");
    let mulaiDatePinjamElement = document.getElementById("tanggal_mulai_peminjaman");

    let awalDate = mulaiDatePinjamElement.value;
    let akhirDate = akhirDatePinjamElement.value;

    let day = changeAmmountDay(awalDate, akhirDate);
    cahangeTotalPrize(day);

    reciptInfoReturn.innerHTML = formatDate(akhirDate);
}

function cahangeTotalPrize(day) 
{
    let btnSubmitElement = document.getElementById("btn_submit");
    let totalPriceInfoElement = document.getElementById("total_price_info");
    let hargaSewaInputElement = document.getElementById("harga_sewa")
    let hargaSewa = hargaSewaInputElement.value;

    let hargaSewaFormat = parseInt(hargaSewa.replace(".",""));

    totalPriceInfoElement.setAttribute("price", day + "x" + hargaSewa)
    hargaSewaInputElement.value = hargaSewaFormat;
    
    totalPrice = (day*hargaSewaFormat).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    totalPriceInfoElement.innerHTML = "IDR " + totalPrice;
    btnSubmitElement.innerHTML = "Rent (Rp." + totalPrice + ")";
}

function changeAmmountDay(mulaiDate, akhirDate) 
{
    let borrowDay = document.getElementById("borrow_day");
    let diffInMs = new Date(akhirDate) - new Date(mulaiDate);
    let formatedDay = diffInMs / (1000 * 60 * 60 * 24);
    borrowDay.innerHTML = formatedDay + " Days";
    return formatedDay;
}

function changeAkhirDateValue(minAkhirDate, maxAkhirDate) 
{
    let akhirDatePinjamElement = document.getElementById("tanggal_akhir_peminjaman");
    akhirDatePinjamElement.value = minAkhirDate;
    akhirDatePinjamElement.setAttribute('min', minAkhirDate);
    akhirDatePinjamElement.setAttribute('max', maxAkhirDate);
}

function changeReciptInfo(awalDate, akhirDate) 
{
    let reciptInfoDepart = document.getElementById("recipt_info_depart");
    let reciptInfoReturn = document.getElementById("recipt_info_return");

    reciptInfoDepart.innerHTML = formatDate(awalDate);
    reciptInfoReturn.innerHTML = formatDate(akhirDate);
}

function formatDate(currentDate)
{
    var options = { weekday: 'long', year: 'numeric', month: '2-digit', day: '2-digit' };
    var today = new Date(currentDate);
    return today.toLocaleDateString("en-US", options).replaceAll("/", "-");
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
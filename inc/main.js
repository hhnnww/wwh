$(".widget").pin({
    minWidth: 992,
    padding: {
        top: 20,
        bottom: 10
    }
});

function tijiao() {
    var yd_name = document.getElementById('yd-name').value;
    var yd_url = document.getElementById('yd-url').value;
    var yd_phone = document.getElementById('yd-phone').value;
    var yd_jihua = document.getElementById('yd-jihua').value;

    if (document.getElementById('yd-phone').value == '') {
        document.getElementById('info').innerHTML = '微信或手机不能为空哦，不然我们导游无法联系上您。';
        document.getElementById('info').className -= '';
        document.getElementById('info').className += ' alert small mt-3 text-center alert-danger';

        document.getElementById('yd-phone').className -= '';
        document.getElementById('yd-phone').className += ' form-control border border-primary';
    } else {
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('POST', '/wp-content/themes/wwh/inc/yuding.php', true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send('yd-name=' + yd_name + '&yd-url=' + yd_url + '&yd-phone=' + yd_phone + '&yd-jihua=' + yd_jihua);

        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {

                document.getElementById('info').innerHTML = '<svg t="1551920431202" class="icon mr-1" style="margin-top:-3px;width: 1.5em; height: 1.5em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7232" data-spm-anchor-id="a313x.7781069.0.i0"><path d="M699 353h-46.9c-10.2 0-19.9 4.9-25.9 13.3L469 584.3l-71.2-98.8c-6-8.3-15.6-13.3-25.9-13.3H325c-6.5 0-10.3 7.4-6.5 12.7l124.6 172.8c12.7 17.7 39 17.7 51.7 0l210.6-292c3.9-5.3 0.1-12.7-6.4-12.7z" p-id="7233"></path><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64z m0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z" p-id="7234"></path></svg>提交成功，我们导游会在12小时内微信联系您。<br />并且仅在征得您的允许的情况下，我们导游才会用电话给您联系，以免为您造成骚扰。';
                document.getElementById('info').className -= '';
                document.getElementById('info').className += ' alert small mt-3 text-center alert-success';

                document.getElementById('yd-name').value = '';
                document.getElementById('yd-phone').value = '';
                document.getElementById('yd-jihua').value = '';
            }
        }
    }
}
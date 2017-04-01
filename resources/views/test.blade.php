<style>

    .vk {
        border: 1px solid rgba(84, 84, 84, 0.75);
        background: rgba(0, 0, 0, 0.75);
        border-radius: 6px;
        width: 320px;
        height: 95px;
        box-shadow: 0px 1px 20px -3px;
        position: fixed;
        left: 6px;
        bottom: -100px;
        z-index: 1000;
    }
    .vk_titl{
        font-size: 13px;
        font-family: tahoma, arial, verdana, sans-serif, Lucida Sans;
        margin: 8px 0px 0px 10px;
        color: #FEFFFA;
        font-weight: bold;
    }

    .no_avatar{
        width: 50px;
        height: 50px;
        margin: 10px 0px 0px 10px;
        border-radius: 4px;
        background: url("/wp-content/themes/vantage/images/mihail.jpg");
        cursor: pointer;
    }

    .vk_titl2{
        font-size: 13px;
        font-family: tahoma, arial, verdana, sans-serif, Lucida Sans;
        position: absolute;
        left: 70px;
        top: 35px;
        color: #C4E2F9;
        cursor: pointer;
    }

    .vk_titl3{
        font-size: 13px;
        font-family: tahoma, arial, verdana, sans-serif, Lucida Sans;
        position: absolute;
        left: 69px;
        top: 52px;
        color: #FEFFFA;
        width: 243px;
        cursor: pointer;

    }

    .vk_titl3 div a {
        color: #FEFFFA;
        text-decoration: none;
    }

    .clos1{
        font-size: 14px;
        font-family: tahoma, arial, verdana, sans-serif, Lucida Sans;
        position: absolute;
        left: 296px;
        top: 4px;
        color: #FEFFFA;
        width: 13px;
        background: rgba(0, 0, 0, 0.48);
        border-radius: 4px;
        padding: 0px 0px 2px 6px;
        cursor: pointer;
    }

    .hidden {
        display: none !important;
    }
</style>


<div class="vk hidden" style="bottom: 20px;" id="soctrek_notify">
    <span class="clos1" id="modal_close" onclick="document.getElementById('soctrek_notify').classList.toggle('hidden')">x</span>
    <div class="vk_titl">Новое сообщение</div>
    <div class="no_avatar" onclick="window.open('https://k-informer.ru/?page_id=700', 'k-informer')">

    </div>
    <div class="vk_titl2">
        <a href="https://k-informer.ru/?p=319" style="text-decoration: none;color: #ABE2ED;">Soctrek Informer</a>
    </div>
    <div class="vk_titl3"><div>
            <a href="https://k-informer.ru/?p=319">У нас повышенный иммунитет к бану.</a>
        </div>
    </div>
</div>

<script>
    (function () {

        let notify = document.getElementById('soctrek_notify');

        function playSound ()
        {
            let sound = new Audio("/assets/music/notify.mp3");

            sound.play();
        }

        function showModal ()
        {
            notify.classList.toggle('hidden');

            playSound();
        }

        let hideModal = function ()
        {
            notify.classList.toggle('hidden');
        };


        setTimeout(function () {
            showModal();
        }, 1000);
    })();
</script>
<?php
if (isset($_REQUEST['page']) AND $_REQUEST['page'] == 'aboutProject')
{

    ?>
    <div class="grid">
        <div class="r4">
            <h2>Миссия компании:</h2>
            <p align="left">Итальянский страховой дом <b>"Дольче Вита"</b>, как один из крупнейших европейских страховых агентств, видит свою миссию в развитии качественных и доступных страховых услуг в России, повышение уровня культуры страхования, а также создание финансовой устойчивости у наших клиентов.</p>
        </div>
    </div>

    <div class="grid">
        <div class="r4">
            <h2>Ценности компании:</h2
            <p align="left">
                <ul>
                    <li>Верность принципам: мы руководствуемся нашими ценностями, поступаем справедливо, и делаем то, что правильно, а не то, что легко;</li>
                    <li>Совершенство во всем, что мы делаем: мы работаем быстро и с энтузиазмом;</li>
                    <li>Обучение и развитие: мы прислушиваемся к другим и учимся с удовольствием;</li>
                    <li>Забота о сотрудниках: мы верим в наших людей, развиваем их и доверяем им;</li>
                    <li>Мы одна команда: мы верим в силу командной работы и вклад каждого в результат;</li>
                    <li>Победа вместе с клиентами: наши клиенты - в центре всего, что мы делаем.</li>
                </ul>
            </p>
        </div>
    </div>

    <div class="grid">
        <div class="r4">
            <h2>О компании:</h2>
            <p align="left">
                Итальянский страховой дом "Дольче Вита" открыл свое представительство в России в конце 2009 года.
                До 2012 года компания работала как страховое представительство для агентов, практикуя основные виды страхования:
            <ul>
                <li>КАСКО;</li>
                <li>ОСАГО;</li>
                <li>Страхование от Несчастных Случаев;</li>
                <li>Страхование Выезжающих за рубеж;</li>
                <li>Добровольное Медицинское Страхование;</li>
                <li>Страхование имущества юридических и физических лиц и пр.</li>
            </ul>
            В связи с объединением с одним из российских страховщиков бизнес-процессов  в конце 2012 года, Итальянский страховой дом "Дольче Вита" становится эксклюзивным дистрибьютером прямых продаж данного страховщика на Российском рынке.
            </p>
        </div>
    </div>
    <?php
}
elseif (isset($_REQUEST['page']) AND $_REQUEST['page'] == 'contacts')
{
    ?>
    <div class="grid">
        <div class="r4">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_tbl_cont">
                <tr>

                    <td class="content" valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="7">
                            <tr>
                                <td valign="top">
                                    <h2>Контакты:</h2>
                                    <p align="left">
                                        Тел.: +7 (495) 649-02-49<br>
                                        E-mail: <a href="mailto:info@dv-diretto.ru">info@dv-diretto.ru</a></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="center"><h2 align="left">Адрес:</h2><p align="left">г. Москва, ул. Складочная, д.1, стр, 1, вход 4, подъезд 5, офис 2046</p>

                                    <div id="ymaps-map-id_136024007083968054096" style="width: 600px; height: 450px;"></div>
                                    <div style="width: 600px; text-align: right;"><a href="http://api.yandex.ru/maps/tools/constructor/index.xml" target="_blank" style="color: #1A3DC1; font: 13px Arial, Helvetica, sans-serif;">Создано с помощью инструментов Яндекс.Карт</a></div>
                                    <script type="text/javascript">function fid_136024007083968054096(ymaps) {var map = new ymaps.Map("ymaps-map-id_136024007083968054096", {center: [37.5945845, 55.80064140135346], zoom: 14, type: "yandex#map"});map.controls.add("zoomControl").add("mapTools").add(new ymaps.control.TypeSelector(["yandex#map", "yandex#satellite", "yandex#hybrid", "yandex#publicMap"]));map.geoObjects.add(new ymaps.Placemark([37.594584, 55.800448], {balloonContent: 'Итальянский страховой дом "Дольче Вита"'}, {preset: "twirl#darkorangeDotIcon"}));};</script>
                                    <script type="text/javascript" src="http://api-maps.yandex.ru/2.0-stable/?lang=ru-RU&coordorder=longlat&load=package.full&wizard=constructor&onload=fid_136024007083968054096"></script>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

        </div>
    </div>

<?php
}
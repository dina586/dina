<div class="container">
    <aside class="l-left c-left">			
	<div class="l-form j-filter_form">
            <form id="filters" action="/site/search" method="get">		
		<div class="b-search_section">
                    <h3 class="search_title">Поиск по названию</h3>
                    <div class="l-row l-no_label">
                        <div class="form-group">
                            <label class="control-label" for="House_s_name">Название объекта</label>
                            <div><input name="House[s_name]" id="House_s_name" class="form-control" placeholder="Название объекта" type="text"></div>
                        </div>			 
                    </div>
		</div>
		
		<div class="b-search_section">
                    <h3 class="search_title">Область</h3>
                        <div class="l-row l-no_label j-filter_region_id">
                            <div class="form-group">
                                <label class="control-label required" for="House_region_id">Область <span class="required">*</span></label>
                                <div>
                                    <select class="form-control" name="House[region_id]" id="House_region_id">
                                        <option value="">Выберите область</option>
                                        <option value="1">Минская (27)</option>
                                        <option value="2">Брестская (11)</option>
                                        <option value="3">Гродненская (6)</option>
                                        <option value="4">Гомельская (8)</option>
                                        <option value="5">Могилевская (5)</option>
                                        <option value="6">Витебская (13)</option>
                                    </select>
                                </div>
                            </div>	
                        </div>			 			 
		</div>
			
		<div class="b-filter">
                    <div class="b-filter_row">
                        <h3>Тип отдыха</h3>
                        <ul>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_semejnyj">
                                        <input type="checkbox" value="1" name="Filter[semejnyj]" id="Filter_semejnyj">Семейный <span class="j-filter_semejnyj">(69)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_bolyshaja_shumnaja_kompanija">
                                        <input type="checkbox" value="1" name="Filter[bolyshaja_shumnaja_kompanija]" id="Filter_bolyshaja_shumnaja_kompanija">Большая шумная компания <span class="j-filter_bolyshaja_shumnaja_kompanija">(49)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_kak_v_derevne">
                                        <input type="checkbox" value="1" name="Filter[kak_v_derevne]" id="Filter_kak_v_derevne">Как в деревне <span class="j-filter_kak_v_derevne">(53)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_novyj_god">
                                        <input type="checkbox" value="1" name="Filter[novyj_god]" id="Filter_novyj_god">Новый год <span class="j-filter_novyj_god">(64)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_rybalka__ohota">
                                        <input type="checkbox" value="1" name="Filter[rybalka__ohota]" id="Filter_rybalka__ohota">Рыбалка и охота <span class="j-filter_rybalka__ohota">(50)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_svadyba">
                                        <input type="checkbox" value="1" name="Filter[svadyba]" id="Filter_svadyba">Свадьба <span class="j-filter_svadyba">(43)</span>
                                    </label>
                                </div>
                            </li>						
                        </ul>
                    </div>
						
                    <div class="b-filter_row">
                        <h3>Условия проживания</h3>											
                        <div class="l-row l-no_label j-filter_price_id">
                            <div class="form-group">
                                <label class="control-label" for="House_price_id">Стоимость на человека в сутки, $</label>
                                <div>
                                    <select class="form-control" name="House[price_id]" id="House_price_id">
                                        <option value="">Цена на человека</option>
                                        <option value="7">договорная (14)</option>
                                        <option value="1">до 10$ (4)</option>
                                        <option value="2">10$ - 20$ (38)</option>
                                        <option value="3">20$ - 30$ (10)</option>
                                        <option value="4">30$ - 40$ (4)</option>
                                        <option value="5">40$ - 50$ (0)</option>
                                        <option value="6">70$ - 100$ (0)</option>
                                    </select>
                                </div>
                            </div>						
                        </div>
						 
                        <div class="l-row l-no_label j-filter_house_cost_id">
                            <div class="form-group">
                                <label class="control-label" for="House_house_cost_id">Цена дома</label>
                                <div>
                                    <select class="form-control" name="House[house_cost_id]" id="House_house_cost_id">
                                        <option value="">Цена за дом</option>
                                        <option value="11">договорная (38)</option>
                                        <option value="7">50$ - 100$ (14)</option>
                                        <option value="8">100$ - 200$ (9)</option>
                                        <option value="9">200$ - 300$ (5)</option>
                                        <option value="10">300$ - 400$ (1)</option>
                                        <option value="12">400$ - 500$ (2)</option>
                                        <option value="13">500$ - 600$ (1)</option>
                                        <option value="14">более 600$ (0)</option>
                                    </select>
                                </div>
                            </div>						 
                        </div>
						 
                        <div class="l-row l-no_label j-filter_persons_id">
                            <div class="form-group">
                                <label class="control-label required" for="House_persons_id">Количество человек <span class="required">*</span></label>
                                <div>
                                    <select class="form-control" name="House[persons_id]" id="House_persons_id">
                                        <option value="">Количество человек</option>
                                        <option value="1">1 - 5 (3)</option>
                                        <option value="2">5 - 10 (16)</option>
                                        <option value="3">10 - 20 (24)</option>
                                        <option value="4">20 - 30 (5)</option>
                                        <option value="5">30 - 40 (10)</option>
                                        <option value="6">40 - 50 (5)</option>
                                        <option value="7">50 - 70 (1)</option>
                                        <option value="8">70 - 100 (5)</option>
                                        <option value="9">более 100 (1)</option>
                                    </select>
                                </div>
                            </div>						 
                        </div>
						 
                        <div class="l-row l-no_label j-filter_beds_id">
                            <div class="form-group">
                                <label class="control-label required" for="House_beds_id">Количество спальных мест <span class="required">*</span></label>
                                <div>
                                    <select class="form-control" name="House[beds_id]" id="House_beds_id">
                                        <option value="">Количество спальных мест</option>
                                        <option value="1">1 - 5 (3)</option>
                                        <option value="3">5 - 10 (22)</option>
                                        <option value="4">10 - 20 (30)</option>
                                        <option value="5">20 - 30 (9)</option>
                                        <option value="6">30 - 40 (1)</option>
                                        <option value="7">более 40 (5)</option>
                                    </select>
                                </div>
                            </div>						 
                        </div>
						 
                        <ul>						
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_oplata_po_bankovskoj_karte">
                                        <input type="checkbox" value="1" name="Filter[oplata_po_bankovskoj_karte]" id="Filter_oplata_po_bankovskoj_karte">оплата по банковской карте <span class="j-filter_oplata_po_bankovskoj_karte">(21)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_sdajetsya_po_nomeram">
                                        <input type="checkbox" value="1" name="Filter[sdajetsya_po_nomeram]" id="Filter_sdajetsya_po_nomeram">сдается по номерам <span class="j-filter_sdajetsya_po_nomeram">(39)</span>
                                    </label>
                                </div>
                            </li>					
                        </ul>
                    </div>
						
                    <div class="b-filter_row">
                        <h3><img src="/upload/filter_catalog/1.jpg" title="Удобства в доме" alt="Удобства в доме">Удобства в доме</h3>
                        <ul>						
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_dush">
                                        <input type="checkbox" value="1" name="Filter[dush]" id="Filter_dush">душ <span class="j-filter_dush">(67)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_posuda">
                                        <input type="checkbox" value="1" name="Filter[posuda]" id="Filter_posuda">посуда <span class="j-filter_posuda">(64)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_mikrovolnovaja_pechy">
                                        <input type="checkbox" value="1" name="Filter[mikrovolnovaja_pechy]" id="Filter_mikrovolnovaja_pechy">микроволновая печь <span class="j-filter_mikrovolnovaja_pechy">(64)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_otoplenije">
                                        <input type="checkbox" value="1" name="Filter[otoplenije]" id="Filter_otoplenije">отопление <span class="j-filter_otoplenije">(57)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_sputnikovoje_televidenije">
                                        <input type="checkbox" value="1" name="Filter[sputnikovoje_televidenije]" id="Filter_sputnikovoje_televidenije">спутниковое телевидение <span class="j-filter_sputnikovoje_televidenije">(55)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_kamin">
                                        <input type="checkbox" value="1" name="Filter[kamin]" id="Filter_kamin">камин <span class="j-filter_kamin">(53)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_internet">
                                        <input type="checkbox" value="1" name="Filter[internet]" id="Filter_internet">интернет <span class="j-filter_internet">(50)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_konferenc_zal">
                                        <input type="checkbox" value="1" name="Filter[konferenc_zal]" id="Filter_konferenc_zal">конференц зал <span class="j-filter_konferenc_zal">(26)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_banketnyj_zal">
                                        <input type="checkbox" value="1" name="Filter[banketnyj_zal]" id="Filter_banketnyj_zal">банкетный зал <span class="j-filter_banketnyj_zal">(42)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_posudomojechnaja_mashina">
                                        <input type="checkbox" value="1" name="Filter[posudomojechnaja_mashina]" id="Filter_posudomojechnaja_mashina">посудомоечная машина <span class="j-filter_posudomojechnaja_mashina">(15)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_stiralynajamashina">
                                        <input type="checkbox" value="1" name="Filter[stiralynajamashina]" id="Filter_stiralynajamashina">стиральная  машина <span class="j-filter_stiralynajamashina">(53)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_bassejn">
                                        <input type="checkbox" value="1" name="Filter[bassejn]" id="Filter_bassejn">бассейн <span class="j-filter_bassejn">(18)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_dzhakuzi">
                                        <input type="checkbox" value="1" name="Filter[dzhakuzi]" id="Filter_dzhakuzi">джакузи <span class="j-filter_dzhakuzi">(5)</span>
                                    </label>
                                </div>
                            </li>
                            <li class="l-inline_block l-checkbox_styles j-checkbox ">
                                <div class="checkbox">
                                    <label for="Filter_tip_otdyha">
                                        <input type="checkbox" value="1" name="Filter[tip_otdyha]" id="Filter_tip_otdyha">кондиционер <span class="j-filter_tip_otdyha">(15)</span>
                                    </label>
                                </div>
                            </li>					
                        </ul>
                    </div>
						
                    <div class="b-filter_row">
                            <h3>
                                    <img src="/upload/filter_catalog/2.jpg" title="Удобства на территории" alt="Удобства на территории">Удобства на территории					</h3>

										<ul>
						
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_domashnijezhivotnyje"><input type="checkbox" value="1" name="Filter[domashnijezhivotnyje]" id="Filter_domashnijezhivotnyje">домашние  животные <span class="j-filter_domashnijezhivotnyje">(36)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_detskajaploshhadka"><input type="checkbox" value="1" name="Filter[detskajaploshhadka]" id="Filter_detskajaploshhadka">детская  площадка <span class="j-filter_detskajaploshhadka">(45)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_naduvnoj_bassejn"><input type="checkbox" value="1" name="Filter[naduvnoj_bassejn]" id="Filter_naduvnoj_bassejn">надувной бассейн <span class="j-filter_naduvnoj_bassejn">(20)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_sportivnajaploshhadka"><input type="checkbox" value="1" name="Filter[sportivnajaploshhadka]" id="Filter_sportivnajaploshhadka">спортивная  площадка <span class="j-filter_sportivnajaploshhadka">(39)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_gamak"><input type="checkbox" value="1" name="Filter[gamak]" id="Filter_gamak">гамак  <span class="j-filter_gamak">(37)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_sad"><input type="checkbox" value="1" name="Filter[sad]" id="Filter_sad">сад <span class="j-filter_sad">(53)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_mangal"><input type="checkbox" value="1" name="Filter[mangal]" id="Filter_mangal">мангал <span class="j-filter_mangal">(70)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_park1"><input type="checkbox" value="1" name="Filter[park1]" id="Filter_park1">парк <span class="j-filter_park1">(31)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_banya"><input type="checkbox" value="1" name="Filter[banya]" id="Filter_banya">баня  <span class="j-filter_banya">(62)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_vodojem"><input type="checkbox" value="1" name="Filter[vodojem]" id="Filter_vodojem">водоём <span class="j-filter_vodojem">(57)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_besedka"><input type="checkbox" value="1" name="Filter[besedka]" id="Filter_besedka">беседка <span class="j-filter_besedka">(66)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_bassejn1"><input type="checkbox" value="1" name="Filter[bassejn1]" id="Filter_bassejn1">бассейн <span class="j-filter_bassejn1">(16)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_parkovka"><input type="checkbox" value="1" name="Filter[parkovka]" id="Filter_parkovka">парковка <span class="j-filter_parkovka">(69)</span></label></div>
</li>					</ul>
				</div>
						
				<div class="b-filter_row">
					<h3>
						<img src="/upload/filter_catalog/3.jpg" title="Развлечения" alt="Развлечения">Развлечения					</h3>

										<ul>
						
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_strelyba_izpnevmatiki"><input type="checkbox" value="1" name="Filter[strelyba_izpnevmatiki]" id="Filter_strelyba_izpnevmatiki">стрельба из  пневматики <span class="j-filter_strelyba_izpnevmatiki">(10)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_bilyjard"><input type="checkbox" value="1" name="Filter[bilyjard]" id="Filter_bilyjard">бильярд <span class="j-filter_bilyjard">(19)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_domashnij_muzej"><input type="checkbox" value="1" name="Filter[domashnij_muzej]" id="Filter_domashnij_muzej">домашний музей <span class="j-filter_domashnij_muzej">(21)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_kvadrocikl"><input type="checkbox" value="1" name="Filter[kvadrocikl]" id="Filter_kvadrocikl">квадроцикл <span class="j-filter_kvadrocikl">(10)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_vodnyje_lyzhi"><input type="checkbox" value="1" name="Filter[vodnyje_lyzhi]" id="Filter_vodnyje_lyzhi">водные лыжи <span class="j-filter_vodnyje_lyzhi">(4)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_nastolynyjeigry"><input type="checkbox" value="1" name="Filter[nastolynyjeigry]" id="Filter_nastolynyjeigry">настольные  игры <span class="j-filter_nastolynyjeigry">(41)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_karaoke"><input type="checkbox" value="1" name="Filter[karaoke]" id="Filter_karaoke">караоке <span class="j-filter_karaoke">(36)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_gidrocikl"><input type="checkbox" value="1" name="Filter[gidrocikl]" id="Filter_gidrocikl">гидроцикл <span class="j-filter_gidrocikl">(1)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_darts1"><input type="checkbox" value="1" name="Filter[darts1]" id="Filter_darts1">дартс <span class="j-filter_darts1">(33)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_aerohokkej"><input type="checkbox" value="1" name="Filter[aerohokkej]" id="Filter_aerohokkej">аэрохоккей  <span class="j-filter_aerohokkej">(2)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_progulka_na_lodke"><input type="checkbox" value="1" name="Filter[progulka_na_lodke]" id="Filter_progulka_na_lodke">прогулка на лодке <span class="j-filter_progulka_na_lodke">(31)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_progulka_na_katere"><input type="checkbox" value="1" name="Filter[progulka_na_katere]" id="Filter_progulka_na_katere">прогулка на катере <span class="j-filter_progulka_na_katere">(16)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_trenazhernyjzal"><input type="checkbox" value="1" name="Filter[trenazhernyjzal]" id="Filter_trenazhernyjzal">тренажерный  зал <span class="j-filter_trenazhernyjzal">(5)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_katamaran"><input type="checkbox" value="1" name="Filter[katamaran]" id="Filter_katamaran">катамаран <span class="j-filter_katamaran">(10)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_nastolynyjtennis"><input type="checkbox" value="1" name="Filter[nastolynyjtennis]" id="Filter_nastolynyjtennis">настольный  теннис <span class="j-filter_nastolynyjtennis">(18)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_futbol"><input type="checkbox" value="1" name="Filter[futbol]" id="Filter_futbol">футбол <span class="j-filter_futbol">(28)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_kacheli"><input type="checkbox" value="1" name="Filter[kacheli]" id="Filter_kacheli">качели  <span class="j-filter_kacheli">(44)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_volejbol"><input type="checkbox" value="1" name="Filter[volejbol]" id="Filter_volejbol">волейбол  <span class="j-filter_volejbol">(34)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_basketbol"><input type="checkbox" value="1" name="Filter[basketbol]" id="Filter_basketbol">баскетбол <span class="j-filter_basketbol">(13)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_velosipedy"><input type="checkbox" value="1" name="Filter[velosipedy]" id="Filter_velosipedy">велосипеды  <span class="j-filter_velosipedy">(37)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_verkhovajajezda"><input type="checkbox" value="1" name="Filter[verkhovajajezda]" id="Filter_verkhovajajezda">верховая  езда <span class="j-filter_verkhovajajezda">(28)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_tennisnyjkort"><input type="checkbox" value="1" name="Filter[tennisnyjkort]" id="Filter_tennisnyjkort">теннисный  корт  <span class="j-filter_tennisnyjkort">(3)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_strelybaiz_luka"><input type="checkbox" value="1" name="Filter[strelybaiz_luka]" id="Filter_strelybaiz_luka">стрельба  из лука <span class="j-filter_strelybaiz_luka">(6)</span></label></div>
</li>					</ul>
				</div>
						
				<div class="b-filter_row">
					<h3>
						<img src="/upload/filter_catalog/4.jpg" title="Услуги" alt="Услуги">Услуги					</h3>

										<ul>
						
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_organizacijaprojezda"><input type="checkbox" value="1" name="Filter[organizacijaprojezda]" id="Filter_organizacijaprojezda">организация  проезда <span class="j-filter_organizacijaprojezda">(49)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_obuchenijeremeslu"><input type="checkbox" value="1" name="Filter[obuchenijeremeslu]" id="Filter_obuchenijeremeslu">обучение ремеслу <span class="j-filter_obuchenijeremeslu">(17)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_pitanije"><input type="checkbox" value="1" name="Filter[pitanije]" id="Filter_pitanije">питание <span class="j-filter_pitanije">(57)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_ohota"><input type="checkbox" value="1" name="Filter[ohota]" id="Filter_ohota">охота <span class="j-filter_ohota">(26)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_provedenije_meroprijatij"><input type="checkbox" value="1" name="Filter[provedenije_meroprijatij]" id="Filter_provedenije_meroprijatij">проведение мероприятий  <span class="j-filter_provedenije_meroprijatij">(47)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_sobiranije_jagod_i_gribov"><input type="checkbox" value="1" name="Filter[sobiranije_jagod_i_gribov]" id="Filter_sobiranije_jagod_i_gribov">собирание ягод и грибов <span class="j-filter_sobiranije_jagod_i_gribov">(57)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_rybalka"><input type="checkbox" value="1" name="Filter[rybalka]" id="Filter_rybalka">рыбалка <span class="j-filter_rybalka">(55)</span></label></div>
</li>
<li class="l-inline_block l-checkbox_styles j-checkbox "><div class="checkbox"><label for="Filter_ekskursii"><input type="checkbox" value="1" name="Filter[ekskursii]" id="Filter_ekskursii">экскурсии <span class="j-filter_ekskursii">(55)</span></label></div>
</li>					</ul>
				</div>
						
		</div>
		
		<div class="b-search_buttons">
			<button class="btn btn-warning btn-sm" type="submit" name="yt0"><span class="glyphicon glyphicon-search"></span> Искать</button>			<a class="btn btn-warning btn-sm" href="/site/search"><span class="glyphicon glyphicon-refresh"></span> Очистить</a>		</div>
		</form>		
	</div>
	<section class="b-view_filter j-filter_view">
		<a href="#">Показать фильтры</a>
	</section>
				<div class="b-front_showplace j-showplace_container">
		<h3>Достопримечательности Беларуси</h3>
			<div class="b-front_showplace_item j-showplace_item">
			
			<a href="/showplace/view/istoricheskaja-kreposty-v-gorode-bobrujske">
				<img src="/upload/showplace/14.jpg" title="Историческая крепость в городе Бобруйске" alt="Историческая крепость в городе Бобруйске">			</a>
		
			<a class="l-inline_block" href="/showplace/view/istoricheskaja-kreposty-v-gorode-bobrujske">Историческая крепость в городе Бобруйске</a>
		</div>

		<div class="b-front_showplace_item j-showplace_item">
			
			<a href="/showplace/view/nesvizhskij-zamok">
				<img src="/upload/showplace/13.jpg" title="Несвижский замок" alt="Несвижский замок">			</a>
		
			<a class="l-inline_block" href="/showplace/view/nesvizhskij-zamok">Несвижский замок</a>
		</div>

		<div class="b-front_showplace_item j-showplace_item">
			
			<a href="/showplace/view/mirskij-zamok">
				<img src="/upload/showplace/12.jpg" title="Мирский замок" alt="Мирский замок">			</a>
		
			<a class="l-inline_block" href="/showplace/view/mirskij-zamok">Мирский замок</a>
		</div>

		<div class="b-front_showplace_item j-showplace_item">
			
			<a href="/showplace/view/golyshanskij-zamok-ruiny-zamka-sapeg">
				<img src="/upload/showplace/11.jpg" title="Гольшанский замок. Руины замка Сапег" alt="Гольшанский замок. Руины замка Сапег">			</a>
		
			<a class="l-inline_block" href="/showplace/view/golyshanskij-zamok-ruiny-zamka-sapeg">Гольшанский замок. Руины замка Сапег</a>
		</div>

		<div class="b-front_showplace_view_more">
			<a href="/showplace">Показать еще</a>
		</div>
	</div>
		</aside>


</div>
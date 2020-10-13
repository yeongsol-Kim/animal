<div class="container" style="margin-top: 30px;">
  <div class="creature-tabs">
    <ul class="creature-tab">
      <li class="tab tab-active" id="insect">
        곤충
      </li>
      <li class="tab" id="fish" >
        물고기
      </li>
      <li class="tab" id="seaCreature">
        해산물
      </li>
    </ul>
  </div>
  <div class="tab-content" id="myTabContent">
    <div class="ill-title">
      <span class="table-title"><span class="tabs tab-fish" style="color: #58D3F7;">물고기 </span> <span class="tabs tab-insect" style="color: #89CAA2;">곤충</span> <span class="tabs tab-seaCreature" style="color: #89CAA2;">해산물</span> 도감</span>
        <div class="search" style="text-align: right;">
          <input type="button" class="btn btn-primary" id="btn-realtime" value="실시간" style=" display: inline-block;">
          <input type="button" class="btn btn-danger" id="btn-reset-time" value="시간 초기화" style=" display: inline-block;">
          <input type="time" class="form-control" id="search-time" style="width: 150px; display: inline-block;">
          <input type="text" class="form-control" id="search" placeholder="이름 검색" style="width: 150px; display: inline-block;">
        </div>
      </div>
      <div class="btn-group btn-group-toggle" data-toggle="buttons" style="width: 100%;">
        <label class="btn btn-secondary active">
          <input type="radio" id="btn-month-all" value="all" class="btn-month" checked> 전체 </input>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" id="btn-month-1" value="1" class="btn-month"> 1월 </input>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" id="btn-month-2" value="2" class="btn-month"> 2월 </input>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" id="btn-month-3" value="3" class="btn-month"> 3월 </input>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" id="btn-month-4" value="4" class="btn-month"> 4월 </input>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" id="btn-month-5" value="5" class="btn-month"> 5월 </input>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" id="btn-month-6" value="6" class="btn-month"> 6월 </input>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" id="btn-month-7" value="7" class="btn-month"> 7월 </input>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" id="btn-month-8" value="8" class="btn-month"> 8월 </input>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" id="btn-month-9" value="9" class="btn-month"> 9월 </input>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" id="btn-month-10" value="10" class="btn-month"> 10월 </input>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" id="btn-month-11" value="11" class="btn-month"> 11월 </input>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" id="btn-month-12" value="12" class="btn-month"> 12월 </input>
        </label>
      </div>
      <table id="fish-table" class="table-ill table table-hover table-striped tabs tab-fish">
        <thead>
          <tr>
            <th class="th-sort" scope="col"># <span class="fa fa-sort"></span></th>
            <th class="th-sort" scope="col">이름 <span class="fa fa-sort"></span></th>
            <th scope="col">서식 시기</th>
            <th class="th-sort" scope="col">서식지 <span class="fa fa-sort"></span></th>
            <th class="th-sort" scope="col">출현 시간 <span class="fa fa-sort"></span></th>
            <th class="th-sort" scope="col">크기 <span class="fa fa-sort"></span></th>
            <th class="th-sort" scope="col">판매 가격 <span class="fa fa-sort"></span></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($fishes as $fish): ?>
            <tr>
              <td scope="row"><?=$fish->id?></th>
              <td style="padding: 0px; vertical-align: middle;"><div class="img-back"><img src="<?php echo base_url(); ?>css/img/fishes/<?= $fish->img?>" style="width: 48px;"></div> <?=$fish->name_ko?></td>
              <td class="td-month">
                <div class="row">
                  <?php for ($i = 1; $i <= 12; $i++): ?>
                    <div class="month<?php if($fish->month & pow(2, $i-1)){ echo " month-active";} ?> month-<?=$i?> col-md-3 col-sm-4" style="padding: 0px;"><?=$i?>월</div>
                  <?php endfor; ?>
                </div>
              </td>
              <td><?=$fish->habitat?></td>
              <td class="td-time"><?=$fish->time?></td>
              <td><?=substr($fish->size, 0, 1)?>
              <?php
                switch (substr($fish->size, 0, 1)) {
                  case 1:
                    echo '(매우 작음';
                    break;
                  case 2:
                    echo '(작음';
                    break;
                  case 3:
                    echo '(보통';
                    break;
                  case 4:
                    echo '(큼';
                    break;
                  case 5:
                    echo '(매우 큼';
                    break;
                  case 6:
                    echo '(특대';
                    break;
                  case 7:
                    echo '(길쭉함';
                }
                if(substr($fish->size, 1, 1)) {
                  echo "+ 지느러미";
                }
                echo ")";
              ?>
              </td>
              <td><?=$fish->price?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <table id="insect-table" class="table-ill table table-hover table-striped tabs tab-insect">
        <thead>
          <tr>
            <th class="th-sort" scope="col"># <span class="fa fa-sort"></span></th>
            <th class="th-sort" scope="col">이름 <span class="fa fa-sort"></span></th>
            <th scope="col">서식 시기</th>
            <th class="th-sort" scope="col">서식지 <span class="fa fa-sort"></span></th>
            <th class="th-sort" scope="col">출현 시간 <span class="fa fa-sort"></span></th>
            <th class="th-sort" scope="col">판매 가격 <span class="fa fa-sort"></span></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($insects as $insect): ?>
            <tr>
              <td scope="row"><?=$insect->id-80?></th>
              <td style="padding: 0px; vertical-align: middle;"><div class="img-back"><img src="<?php echo base_url(); ?>css/img/insects/<?=$insect->img?>" style="width: 48px;"></div> <?=$insect->name_ko?></td>
              
              <td class="td-month">
                <div class="row">
                  <?php for($i = 1; $i <= 12; $i++): ?>
                    <div class="month <?php if($insect->month & pow(2, $i-1)){ echo " month-active";} ?> month-<?=$i?> col-md-3 col-sm-4" style="padding: 0px;"><?=$i?>월</div>
                  <?php endfor; ?>
                </div>
              </td>
              <td><?=$insect->habitat?></td>
              <td class="td-time"><?=$insect->time?></td>
              <td><?=$insect->price?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <table id="seaCreature-table" class="table-ill table table-hover table-striped tabs tab-seaCreature">
        <thead>
          <tr>
            <th class="th-sort" scope="col"># <span class="fa fa-sort"></span></th>
            <th class="th-sort" scope="col">이름 <span class="fa fa-sort"></span></th>
            <th scope="col">서식 시기</th>
            <th class="th-sort" scope="col">출현 시간 <span class="fa fa-sort"></span></th>
            <th class="th-sort" scope="col">크기 <span class="fa fa-sort"></span></th>
            <th class="th-sort" scope="col">판매 가격 <span class="fa fa-sort"></span></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($seaCreatures as $sea): ?>
            <tr>
              <td scope="row"><?=$sea->id-160?></th>
              <td style="padding: 0px; vertical-align: middle;"><div class="img-back"><img src="<?php echo base_url(); ?>css/img/sea/<?= $sea->img?>" style="width: 48px;"></div> <?=$sea->name_ko?></td>
              <td class="td-month">
                <div class="row">
                  <?php for ($i = 1; $i <= 12; $i++): ?>
                    <div class="month<?php if($sea->month & pow(2, $i-1)){ echo " month-active";} ?> month-<?=$i?> col-md-3 col-sm-4" style="padding: 0px;"><?=$i?>월</div>
                  <?php endfor; ?>
                </div>
              </td>
              <td class="td-time"><?=$sea->time?></td>
              <td><?=substr($sea->size, 0, 1)?>
              <?php
                switch (substr($sea->size, 0, 1)) {
                  case 1:
                    echo '(작음';
                    break;
                  case 2:
                    echo '(보통';
                    break;
                  case 3:
                    echo '(큼';
                    break;
                }
                if(substr($sea->size, 1, 1)) {
                  echo "+ 지느러미";
                }
                echo ")";
              ?>
              </td>
              <td><?=$sea->price?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
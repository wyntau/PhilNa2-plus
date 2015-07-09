<?php

function philna_query_state(){
  echo '<span style="color: #999;font-size: 11px;font-style: italic;">页面加载: ' . get_num_queries() . ' queries.' . timer_stop() . ' seconds.</span>';
}

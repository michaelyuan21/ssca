<?php if(!class_exists("View", false)) exit("no direct access allowed");?><script type="text/template" id="sunday-paging-tpl">
<div class="libom mt5">
  <div class="paging">
    <!--<span class="tot">共计<b>${paging.total_count}</b>项</span>-->
    {@if paging.current_page >= paging.scope}<a onclick="sundayMsgPageturn(${paging.first_page})">首 页</a>{@/if}
    {@if paging.first_page == paging.current_page}<span class="disabled">上一页</span>{@else}<a onclick="sundayMsgPageturn(${paging.prev_page})">上一页</a>{@/if}
    {@each paging.all_pages as v}
    {@if paging.current_page == v}<span class="cur">${paging.current_page}</span>{@else}<a onclick="sundayMsgPageturn(${v})">${v}</a>{@/if}
    {@/each}
    {@if paging.last_page == paging.current_page}<span class="disabled">下一页</span>{@else}<a onclick="sundayMsgPageturn(${paging.next_page})">下一页</a>{@/if}
    {@if paging.total_page - paging.current_page >= paging.scope}<a onclick="sundayMsgPageturn(${paging.last_page})">末 页</a>{@/if}
    <span class="pct"><b>${paging.current_page}</b> / ${paging.total_page}</span>
  </div>
</div>
</script>
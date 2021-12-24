<div class="post-left">
  <div class="content">
    <?php //骨架?>
    <?php $this->need("components/post/post-skeleton.php");?>
    <div class="content-warp hide">
      <div class="left-head">
        <a class="avatar" href="<?php $this->author->permalink(); ?>" >
          <?php $this->author->gravatar(80); ?> 
        </a>
        <div class="info">
          <h3 class="title">
            <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
          </h3>
        <p class="subtitle">
          <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date("Y年m月d日"); ?></time>
          <span>阅读：<?php views($this); ?></span>
        </p>
        </div>
        <?php if ($this->user->hasLogin()) : ?>
          <a class="edit" href="<?php $this->options->adminUrl(); ?>write-<?php if ($this->is('post')) : ?>post<?php else : ?>page<?php endif; ?>.php?cid=<?php echo $this->cid; ?>" target="_self">编辑</a>
        <?php endif; ?>
      </div>
      <div class="article-end-time">
        最后更新：<?php echo date('Y/m/d/ G:i:s' , $this->modified); ?>
      </div>
      <div class="left-body">
        <?php $titleImg = getArticleTitleImg($this);?>
        <?php if($titleImg): ?>
          <div class="title-img">
            <img src="<?php echo $titleImg;?>" alt="<?php $this->title() ?>">
          </div>
        <?php endif;?>
        <h1 class="article-title" itemprop="name headline"><?php $this->title() ?></h1>
        <div class="article-content">
          <div id="markdown">
            <?php
              $db = Typecho_Db::get();
              $sql = $db->select()->from('table.comments')
                ->where('cid = ?', $this->cid)
                ->where('mail = ?', $this->remember('mail', true))
                ->where('status = ?', 'approved')
                //只有通过审核的评论才能看回复可见内容
                ->limit(1);
              $result = $db->fetchAll($sql);
              $content = $this->content;
              //a链接增加_blank                
              $content = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/sm', '<a href="$1" target="_blank">$2</a>', $content);
              //灯箱
              $content = preg_replace_callback('%<img src="(.*?)" alt="(.*?)" title="(.*?)">%sm',function($match){
              return '<img class="light-box" src="'.urldecode($match[1]).'" alt="'.$match[2].'" title="'.$match[3].'">';
              },$content);
              //todo
              $content = preg_replace('/\[x\]/sm', '<i class="icon icon-check-square todo"></i> ', $content);
              $content = preg_replace('/\[\s\]/sm', '<i class="icon icon-border todo"></i> ', $content);
              //代码高亮
              $content = preg_replace('%<pre>(.*?)</pre>%sm', '<pre class="line-numbers">$1</pre>', $content);
              //表格
              $content = preg_replace('/<table>(.*?)<\/table>/sm', '<div class="table-responsive"><table>$1</table></div>', $content);
              //回复可见
              if ($this->user->hasLogin() || $result) {
                $content = preg_replace("/\[hide\](<br>)?(.*?)\[\/hide\]/sm", '<fieldset class="respond-view"><legend>隐藏的内容</legend><div class="layui-field-box">$2</div></fieldset>', $content);
              } else {
                $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm", '<div class="respond-visible">此处内容已隐藏<a  href="#comments">回复</a>后方可阅读。</div>', $content);
              }
              echo $content
              ?>
          </div>
        </div>
        <div class="article-tag">
          <div class="tag-warp">
            <span class="tag-title">文章分类</span>
            <span class="tag-list">
              <?php $this->category('',true,'<a href="javascript:;">暂无分类</a>'); ?>
            </span>
          </div>
          <div class="tag-warp">
            <span class="tag-title">文章标签</span>
            <span class="tag-list">
              <?php $this->tags('', true, '<a href="javascript:;">暂无标签</a>'); ?>
            </span>
          </div>
        </div>
        <div class="article-author">
          <a href="<?php $this->author->permalink(); ?>">
            <div class="author-content">
              <div class="author-avatar">
                <?php $this->author->gravatar(80); ?> 
              </div>
              <div class="author-info">
                <div class="info-top">
                  <h3 class="title"><?php $this->author(); ?></h3>
                  <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished">
                    <?php $this->date('Y年m月d日'); ?>
                  </time>
                </div>
                <div class="info-bottom">
                    <span>发布了 <?php authArticleTotal($this->author->uid);?> 篇文章</span
                    ><span>获得点赞 <?php echo getLikeCount($this->cid); ?></span
                    ><span>获得阅读 <?php views($this); ?></span>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="article-declaration">
          <h3 class="title">版权申明</h3>
          <p class="subtitle">本文系作者 <a href="<?php $this->author->permalink(); ?>">@<?php $this->author(); ?></a> 原创发布在<?php $this->options->title(); ?>站点。未经许可，禁止转载。</p>     
        </div>
      </div>
      <div class="left-footer">
        <?php $this->need("components/comments/index.php");?>     
      </div>
    </div>
  </div>
  <?php //相关文章 ?>
  <?php $this->need("components/post/related-articles.php");?>
</div>
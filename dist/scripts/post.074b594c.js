"use strict";(self.webpackChunkwebpack_multiple_entry=self.webpackChunkwebpack_multiple_entry||[]).push([[205],{1115:function(t,s,e){var i=e(1800),n=(e(3823),e(5187),e(1153),e(7932));new class{constructor(){(0,i.A)(this,"list",document.querySelector(".articles-related-list")),(0,i.A)(this,"commentBtnClass","comments"),(0,i.A)(this,"listItemClass","articles-related-list-item"),(0,i.A)(this,"blackClassList",["author","comments","articles-related-list-item-tag"]),(0,i.A)(this,"eventProxy",(t=>{const s=t.target;if(this.hasBlackClass(s))return;if(this.hasClassName(s,this.commentBtnClass))return;const e=this.getClassNameElement(s,this.listItemClass);if(!e)return n.A.warning({text:"未找到文章卡片"});const i=e.dataset.link;"string"==typeof i&&""!==i.trim()?location.href=i:n.A.warning({text:"未找到卡片的文章链接"})})),this.list&&this.list.addEventListener("click",this.eventProxy)}hasClassName(t,s){if(t.classList.contains(s))return!0;const e=t.parentElement;return!!e&&this.hasClassName(e,s)}getClassNameElement(t,s){if(t.classList.contains(s))return t;const e=t.parentElement;return e?this.getClassNameElement(e,s):null}hasBlackClass(t){return-1!==Array.from(t.classList).findIndex((t=>this.blackClassList.includes(t)))}},e(2785),e(8750);var a=e(5293);new class{constructor(){(0,i.A)(this,"wrap",document.querySelector(".post-right-sticky")),(0,i.A)(this,"listenHeaderShow",(t=>{t?this.wrap?.classList.add("heighten"):this.wrap?.classList.remove("heighten")})),a.A.on(a.k.HEADER_SHOW,this.listenHeaderShow)}}}},function(t){var s=function(s){return t(t.s=s)};t.O(0,[96,76],(function(){return s(1307),s(1115)})),t.O()}]);
(window.webpackJsonp=window.webpackJsonp||[]).push([["chunk-178b"],{"Hb/m":function(e,t,r){"use strict";r.r(t);var s=r("gDS+"),o=r.n(s),a=r("xKIC"),i=r("/yXQ"),n=r("glbJ"),l=r("Muo0"),u=r("U/5H"),c=r.n(u),m=r("UMyc"),d={name:"EnterpriseEdit",components:{DndList:a.a,UpLoad:i.a,QuesSel:l.a,Tinymce:n.a},data:function(){return{sortable:null,formMark:!1,path:"special",ossParams:{},ulParamsMark:!1,listLoading:!1,listQuery:"",courseList:[],cdn:"https://cdncollege.quansuwangluo.com/",bEdit:!1,qrcodeList:[],catName:["","基","进","高"],form:{course:[],course_ids:[],title:"",id:0,num:"",status:0,contents:"",tab:"",pic:null,qrcode:[]},formRules:{title:[{required:!0,message:"请输入专训名称",trigger:"blur"}],apply_time:[{required:!0,message:"请选择报名时间",trigger:"blur"}],contents:[{required:!0,message:"请输入专训介绍",trigger:"blur"}],tab:[{required:!0,message:"请输入标识",trigger:"blur"}],pic:[{required:!0,message:"请上传图片",trigger:"blur"}],num:[{required:!0,message:"请输入招生学员数量"}],qrcode:[{required:!0,message:"请上传图片",trigger:"blur"}]}}},mounted:function(){var e=this;this.bEdit="0"!==this.$route.params.id,this.formMark=!1,this.bEdit?this.getInfos(this.$route.params.id):this.getCourseList(),Object(m.j)({type:"dev_test_dcaredata"}).then(function(t){e.ossParams=t.data.datas,e.ulParamsMark=!0,e.listLoading=!1})},methods:{getCourseList:function(){var e=this;this.listLoading=!0,Object(m.i)("course",{page:1,limit:99999}).then(function(t){e.form.course=t.data.datas.course,e.listLoading=!1,e.formMark=!0,e.$nextTick(function(){e.setSort()})})},setSort:function(){var e=this,t=document.querySelectorAll(".divCourse")[0];this.sortable=c.a.create(t,{ghostClass:"sortable-ghost",setData:function(e){e.setData("Text","")},onEnd:function(t){var r=e.form.course.splice(t.oldIndex,1)[0];e.form.course.splice(t.newIndex,0,r)}})},getInfos:function(e){var t=this;this.listLoading=!0,Object(m.g)(this.path,{id:e}).then(function(e){t.formMark=!0,t.bEdit&&(t.form=e.data.datas,t.qrcodeList=t.formatImg(t.form.qrcode)),t.listLoading=!1,t.$nextTick(function(){t.setSort()})})},formatImg:function(e){var t=this,r=[];return e.forEach(function(e,s,o){var a={uid:"",url:"",name:""};a.name=e.substring(e.length-6),a.url=t.cdn+e,a.uid=e.replace(/[^0-9]/gi,""),r.push(a)}),r},uploadSucess:function(e){console.log(e),null!==e.res_url&&(2===e.type&&(this.form.qrcode=e.res_url),3===e.type&&(-1===e.index&&(this.form.pic=e.res_url),-2===e.index&&(this.form.poster=e.res_url),-3===e.index&&(this.form.qrcode=e.res_url)))},addCourse:function(){var e=this;this.listLoading=!0,Object(m.a)(this.path,this.form).then(function(t){e.listLoading=!1,e.$message(t.data.message),e.$store.dispatch("delView",e.$route),e.$router.replace("/enterprise/index"),sessionStorage.setItem("refresh",o()(1))})},onSubmit:function(e){var t=this;console.log(this.form),this.$refs.form.validate(function(r){r&&(t.form.id=2===e?0:t.form.id,t.addCourse())})},onCancel:function(){this.$message({message:"cancel!",type:"warning"})}}},f=(r("wjqm"),r("KHd+")),p=Object(f.a)(d,function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"app-container"},[e.formMark?r("el-form",{ref:"form",attrs:{model:e.form,rules:e.formRules,"label-width":"260px"}},[r("el-form-item",{attrs:{label:"专训名称",prop:"title"}},[r("el-input",{model:{value:e.form.title,callback:function(t){e.$set(e.form,"title",t)},expression:"form.title"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"专训标识",prop:"tab"}},[r("el-input",{model:{value:e.form.tab,callback:function(t){e.$set(e.form,"tab",t)},expression:"form.tab"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"专训封面(推荐尺寸:474 x 354)",prop:"pic"}},[e.ulParamsMark&&e.formMark?r("up-load",{attrs:{"single-pic":e.bEdit?e.cdn+e.form.pic:e.form.pic,index:-1,type:3,ossparas:e.ossParams},on:{uploadSucess:e.uploadSucess}}):e._e()],1),e._v(" "),r("el-form-item",{attrs:{label:"二维码(推荐尺寸: 960 x 720)"}},[e.ulParamsMark&&e.formMark?r("up-load",{attrs:{filelists:e.qrcodeList,index:1,type:2,ossparas:e.ossParams},on:{uploadSucess:e.uploadSucess}}):e._e()],1),e._v(" "),r("el-form-item",{attrs:{label:"是否上架"}},[r("el-radio-group",{model:{value:e.form.status,callback:function(t){e.$set(e.form,"status",t)},expression:"form.status"}},[r("el-radio",{attrs:{label:1}},[e._v("是")]),e._v(" "),r("el-radio",{attrs:{label:0}},[e._v("否")])],1)],1),e._v(" "),r("el-form-item",{attrs:{label:"报名时间",prop:"apply_time"}},[r("el-date-picker",{attrs:{type:"datetimerange","range-separator":"至","start-placeholder":"开始时间","end-placeholder":"结束时间","value-format":"yyyy-MM-dd HH:mm:ss"},model:{value:e.form.apply_time,callback:function(t){e.$set(e.form,"apply_time",t)},expression:"form.apply_time"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"报名人数",type:"number",onkeypress:"return( /[\\d]/.test(String.fromCharCode(event.keyCode) ) )",prop:"num"}},[r("el-input",{model:{value:e.form.num,callback:function(t){e.$set(e.form,"num",t)},expression:"form.num"}})],1),e._v(" "),r("el-form-item",{attrs:{rules:{required:!0,message:"请选择课程",trigger:"blur"},label:"选择课程"}},[r("el-checkbox-group",{staticClass:"divCourse",model:{value:e.form.course_ids,callback:function(t){e.$set(e.form,"course_ids",t)},expression:"form.course_ids"}},[r("el-checkbox",{staticStyle:{display:"none"}}),e._v(" "),e._l(e.form.course,function(t){return r("el-checkbox",{key:t.id,attrs:{label:t.id,value:t.id}},[e._v(" "+e._s(t.title+"("+e.catName[t.catid]+")"))])})],2)],1),e._v(" "),r("el-form-item",{attrs:{label:"专训介绍:",prop:"contents"}},[r("div",[r("tinymce",{attrs:{height:300},model:{value:e.form.contents,callback:function(t){e.$set(e.form,"contents",t)},expression:"form.contents"}})],1)]),e._v(" "),r("el-form-item",[r("el-button",{attrs:{type:"primary"},on:{click:function(t){e.onSubmit(1)}}},[e._v("保存")]),e._v(" "),r("el-button",{attrs:{type:"primary"},on:{click:function(t){e.onSubmit(2)}}},[e._v("保存为新专训")])],1)],1):e._e()],1)},[],!1,null,"c1cf3682",null);p.options.__file="options.vue";t.default=p.exports},U1Nk:function(e,t,r){},wjqm:function(e,t,r){"use strict";var s=r("U1Nk");r.n(s).a}}]);
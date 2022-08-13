<template>
 <div>
  <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <router-link to="/hr/dashboard" style="text-decoration: none;">Dashboard</router-link>
                        </li>
                        <li class="breadcrumb-item active">Reports
                        </li>
                    </ol>
                </div>
            </div>
            <div class="content-body">
                                <b-row style="padding-bottom:15px;">
                                            <b-col md="12" sm="12">
                                                <label style="padding-bottom:20px;">Upload Your thumbnail Image<span style="color:red;font-size:20px">*</span></label>
                                            </b-col>
                                            <b-col md="4" sm="4">
                                                <div class="form-group">
                                                    <img v-if="url" :src="url" class="img-responsive" height="90" width="90">
                                                </div>
                                            </b-col>
                                           
                                        </b-row>
                                         <button @click="submit_form()" class="btn btn-success">Save Product</button>

                     <form method="post" enctype="multipart/form-data">
  <div class="image">
      <input type="file" id="image_file" :v-model="image_file" name="image_file" @change="onFileChange"
        accept="image/*" class="input-file">
         <p v-if="!url">Click to browse your image</p>
        <img v-if="url" :src="url" class="img img-responsive full-width" />
    </div>
  </form>

            </div>
        </div>
        <organization-chart :datasource="ds" @node-click="log">
        <template slot-scope="{ nodeData }">
          <div :class="['node-box',  nodeData.id == '1' ? 'parent' : '']">
            <div class="node-title">{{nodeData.name}}</div>
            <div class="node-content">
             
              <div>{{nodeData.title}} {{nodeData.id}}</div>
            </div>
          </div>
        </template>
      </organization-chart>
    </div>
   
   </div>
</template>

<script>
import OrganizationChart from 'vue-organization-chart'
import 'vue-organization-chart/dist/orgchart.css'
const image = "";
    export default {
    components: {
      OrganizationChart
    },
    data(){
    return {
     url: null,
     image_file:'',
     image,
     ds: {
        
        id: "1",
        name: "Lao Lao",
        title: "general manager",
      
        children: [
        { id: "10", name: "Muqaddas Rzza", title: "Development Team Lead",
        children: [
        { id: "11", name: "Shahbaz", title: "Development Developer"},
        ]
         },
    ],

      }
    }
    },
    methods:{
   
       
         onFileChange(e) {
         let files = e.target.files || e.dataTransfer.files;
         if (!files.length) {
             console.log('no files');
         }
        
         console.log(files[0]);
         const file = files[0];
         this.image=files[0];
         this.url = URL.createObjectURL(file);
         
      },
       submit_form(e){

      
       const formData = new FormData();
         formData.append('image_file', this.image, this.image.name);
         axios.post('./test_image/submit', formData, {}).then((response) => {
            console.log(response.data)
         })
         .catch(function(err){
             console.log(err)
         });
        },
    },
        mounted() {
            console.log('Controller')
        }
    }
</script>
<style scoped>
.orgchart-container {
  height: 800px;
}
.orgchart {
  background: #000;
}
.node-box {
  border: 1px solid red;
  position: relative;
  /* &.parent::before {
    content: "";
    display: none;
  } */
}
.node-title {
  background: #ccc;
}
.node-content {
  background-color: #fff;
  color: #000;
}
.node-box::before {
  content: "▼";
  position: absolute;
  top: -16px;
  left: 50%;
  color: red;
  margin-left: -8px;
}
</style>

 
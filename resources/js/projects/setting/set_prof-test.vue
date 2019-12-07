<script>
export default {
  data: function () {
    return {
      prof_data: {
        name: "",
        occupation: "",
        birthday: "",
        profile_header: "",
        profile_detail: "",
        picture: null,
        files: [],

      }
    }
  },

  methods: {
 inputFile: function (newFile, oldFile) {
      if (newFile && oldFile && !newFile.active && oldFile.active) {
        // Get response data
        console.log('response', newFile.response)
        if (newFile.xhr) {
          //  Get the response status code
          console.log('status', newFile.xhr.status)
        }
      }
    },
    /**
     * Pretreatment
     * @param  Object|undefined   newFile   Read and write
     * @param  Object|undefined   oldFile   Read only
     * @param  Function           prevent   Prevent changing
     * @return undefined
     */
    inputFilter: function (newFile, oldFile, prevent) {
      if (newFile && !oldFile) {
        // Filter non-image file
        if (!/\.(jpeg|jpe|jpg|gif|png|webp)$/i.test(newFile.name)) {
          return prevent()
        }
      }

      // Create a blob field
      newFile.blob = ''
      let URL = window.URL || window.webkitURL
      if (URL && URL.createObjectURL) {
        newFile.blob = URL.createObjectURL(newFile.file)
      }
    }

  },
  template: `
  <main class="u-container-y container text-center">
  <ul>
    <li v-for="file in files">{{file.name}} - Error: {{file.error}}, Success: {{file.success}}</li>
  </ul>
  <file-upload
    ref="upload"
    v-model="files"
    post-action="/post.method"
    put-action="/put.method"
    @input-file="inputFile"
    @input-filter="inputFilter"
  >
  Upload file
  </file-upload>
  <button v-show="!$refs.upload || !$refs.upload.active" @click.prevent="$refs.upload.active = true" type="button">Start upload</button>
  <button v-show="$refs.upload && $refs.upload.active" @click.prevent="$refs.upload.active = false" type="button">Stop upload</button>

  </main>`
}
</script>

<style lang="scss" scoped>
.Prof-Set {
  > p, > label {
  }
}
.Prof-Set__image {
  display: inline-block;
  border-radius: 4px;
  background-color: #f1f1f1;
  box-shadow:  0 2px 6px rgba(146, 146, 146, 0.8);
  cursor: pointer;
  input {
    //display: none;
  }
}
</style>
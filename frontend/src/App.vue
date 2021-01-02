<template>
  <main>
    <section class="text-gray-600 body-font relative">
      <div class="container px-5 py-24 mx-auto">
        <div class="px-12 text-base text-center mx-auto" v-if="sendSuccess">
          Thank You, Message has been sent
        </div>
        <div v-else>
          <div class="flex flex-col text-center w-full mb-12">
            <h1
              class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
            >
              Send message
            </h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
              send a message
            </p>
          </div>
          <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <div class="flex flex-wrap -m-2">
              <div class="p-2 w-1/2">
                <div class="relative">
                  <label for="recipient" class="leading-7 text-sm text-gray-600"
                    >Recipient</label
                  >
                  <input
                    type="email"
                    id="recipient"
                    v-model="recipient"
                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                  />
                </div>
              </div>
              <div class="p-2 w-1/2">
                <div class="relative">
                  <label for="email" class="leading-7 text-sm text-gray-600"
                    >Email</label
                  >
                  <input
                    type="email"
                    id="email"
                    v-model="email"
                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                  />
                </div>
              </div>
              <div class="p-2 w-full">
                <div class="relative">
                  <label for="message" class="leading-7 text-sm text-gray-600"
                    >Message</label
                  >
                  <textarea
                    id="message"
                    v-model="message"
                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"
                  ></textarea>
                </div>
              </div>
              <div class="p-2 w-full">
                <div class="relative">
                  <label
                    for="attachment"
                    class="leading-7 text-sm text-gray-600"
                    >Attachments</label
                  ><br />
                  <vue-dropzone
                    ref="myVueDropzone"
                    id="dropzone"
                    :options="dropzoneOptions"
                    @vdropzone-complete="afterUploadComplete"
                    @vdropzone-sending-multiple="sendMessage"
                  ></vue-dropzone>
                </div>
              </div>
              <div class="p-2 w-full">
                <button
                  class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                  @click="shootMessage"
                >
                  Send Message
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
export default {
  data() {
    return {
      sendSuccess: false,
      email: "",
      recipient: "",
      message: "",
      dropzoneOptions: {
        url: "http://127.0.0.1:8000/api/sendmessage",
        thumbnailWidth: 150,
        maxFilesize: 2,
        parallelUploads: 3,
        maxFiles: 3,
        uploadMultiple: true,
        autoProcessQueue: false,
      },
    };
  },
  components: {
    vueDropzone: vue2Dropzone,
  },
  methods: {
    afterUploadComplete: async function (response) {
      if (response.status == "success") {
        console.log("upload successful");
        this.sendSuccess = true;
      } else {
        console.log("upload failed");
      }
    },
    shootMessage: async function () {
      this.$refs.myVueDropzone.processQueue();
    },
    sendMessage: async function (files, xhr, formData) {
      formData.append("email", this.email);
      formData.append("message", this.message);
      formData.append("recipient", this.recipient);
    },
  },
};
</script>



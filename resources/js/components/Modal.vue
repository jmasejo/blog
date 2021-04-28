<template>
  <!-- This example requires Tailwind CSS v2.0+ -->
  <div
    :class="['fixed inset-0 overflow-y-auto', ZIndex]"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="false"
  >
    <div
      class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
    >
      <!--
      Background overlay, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
      <div
        :class="[
          'fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity',
          backGroundStyle,
        ]"
        aria-hidden="true"
      ></div>

      <!-- This element is to trick the browser into centering the modal contents. -->
      <span
        class="hidden sm:inline-block sm:align-middle sm:h-screen"
        aria-hidden="true"
        >&#8203;</span
      >

      <!--
      Modal panel, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        To: "opacity-100 translate-y-0 sm:scale-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100 translate-y-0 sm:scale-100"
        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    -->
      <div
        :class="[
          'inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6',
          ModalStyle,
        ]"
      >
        <div class="sm:col-span-6">
          <label for="about" class="block text-sm font-medium text-gray-700">
            Add Comment
          </label>
          <div class="mt-1">
            <textarea
              id="about"
              name="about"
              rows="3"
              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
            ></textarea>
          </div>
        </div>
        <div class="pt-5">
          <div class="flex justify-end">
            <button
              @click="cancel"
              type="button"
              class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              Cancel
            </button>
            <button
              type="submit"
              @click="save"
              class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              Save
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      modalState: false,
      saveUrl: "",
    };
  },
  mounted() {
    this.$root.$on("onClick", (data) => {
      this.toggleModal();
      this.saveUrl = data;
    });
  },
  methods: {
    toggleModal() {
      this.modalState = !this.modalState;
    },
    cancel() {
      this.modalState = false;
    },
    save() {
      console.log("saved to" + this.saveUrl);
    },
  },
  computed: {
    backGroundStyle() {
      return this.modalState
        ? "ease-out duration-300 opacity-100"
        : " ease-in duration-200 opacity-0";
    },
    ModalStyle() {
      return this.modalState
        ? "ease-out duration-300 opacity-100 translate-y-0 sm:scale-100"
        : "ease-in duration-200 opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95";
    },
    ZIndex() {
      return this.modalState ? " ease-out z-10" : "ease-in -z-5";
    },
  },
};
</script>

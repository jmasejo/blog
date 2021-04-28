<template>
  <main>
    <div class="max-w-7xl mx-auto py-3 sm:px-6 lg:px-8">
      <div class="bg-white px-4 py-2 sm:px-6">
        <div class="flex space-x-3">
          <div class="min-w-0 flex-1">
            <p class="text-sm font-medium text-gray-900">
              <a href="#" class="hover:underline">Evan You</a>
            </p>
            <p class="text-sm text-gray-500">
              <a href="#" class="hover:underline">7 years ago</a>
            </p>
          </div>
          <div class="flex-shrink-0 self-center flex">
            <div class="relative z-30 inline-block text-left"></div>
          </div>
        </div>
      </div>
      <div class="opacity-75 px-4 pb-5 sm:p-6 sm:pt-0">
        <p>
          <b>Vue</b> (pronounced /vjuː/, like view) is a progressive framework for
          building user interfaces. Unlike other monolithic frameworks, Vue is
          designed from the ground up to be incrementally adoptable. The core
          library is focused on the view layer only, and is easy to pick up and
          integrate with other libraries or existing projects. On the other
          hand, Vue is also perfectly capable of powering sophisticated
          Single-Page Applications when used in combination with modern tooling
          and supporting libraries.
        </p>
      </div>

      <div class="relative">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
          <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex items-center justify-between">
          <span> </span>
          <button
            @click="click"
            type="button"
            class="inline-flex items-center shadow-sm px-4 py-1.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            <!-- Heroicon name: solid/plus-sm -->
            <svg
              class="-ml-1.5 mr-1 h-5 w-5 text-gray-400"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              aria-hidden="true"
            >
              <path
                fill-rule="evenodd"
                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                clip-rule="evenodd"
              />
            </svg>
            <span>Comment</span>
          </button>
        </div>
      </div>
    </div>
    <!-- comment   -->

    <Comment
      v-for="comment in comments"
      :key="comment.id"
      :comment="comment"
    ></Comment>

    <Modal />
  </main>
</template>

<script>
import Comment from "../components/Comment";
import Modal from "../components/Modal";

export default {
  name: "Main",
  components: {
    Comment,
    Modal,
  },

  data() {
    return {
      saveLink: "",
      comments: [],
    };
  },

  mounted() {
    this.fetch();

    this.$root.$on("fetch", () => {
      this.fetch();
    });
  },

  methods: {
    fetch() {
      axios
        .get("/api/comment")
        .then((response) => (this.comments = response.data.data))
        .catch(function (error) {
          console.log(error);
        });
    },
    click() {
      this.$root.$emit("addComment", null);
    },
  },
};
</script>

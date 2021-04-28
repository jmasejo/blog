<template>
  <div :class="['max-w-7xl mx-auto sm:px-1 sm:px-6 lg:px-8', depthStyle]">
    <div class="bg-white px-4 py-2 sm:px-6">
      <div class="flex space-x-3">
        <div class="min-w-0 flex-1">
          <p class="text-sm font-medium text-gray-900">
            <a href="#" class="hover:underline text-sm">{{ comment.name }}</a>
          </p>
          <p class="text-sm text-gray-500">
            <a href="#" class="hover:underline text-sm">{{ comment.date }}</a>
          </p>
        </div>
      </div>
    </div>
    <div class="opacity-75 px-4 pb-5 sm:p-6 sm:pt-0">
      <p class="text-sm">
        {{ comment.text }}
      </p>
    </div>

    <div class="relative">
      <div class="absolute inset-0 flex items-center" aria-hidden="true">
        <div class="w-full border-t border-gray-300"></div>
      </div>
      <div class="relative flex items-center justify-between">
        <span> </span>
        <button
          type="button"
          class="inline-flex items-center shadow-sm px-4 py-1.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          v-if="depth <= 1"
          @click="click"
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
</template>

<script>
export default {
  props: {
    comment: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      depth: 0,
    };
  },

  mounted() {
    this.depth = this.comment.depth;
  },

  methods: {
    click() {
      this.$root.$emit('onClick', this.saveLink);
    },
  },

  computed: {
    saveLink() {
      return "url/" + this.comment.id;
    },
    depthStyle() {
      switch (this.depth) {
        case 1:
          return "lg:pl-24 md:pl-24 sm:pl-24";
          break;
        case 2:
          return "lg:pl-32 md:pl-32 sm:pl-32";
          break;
        default:
          return "lg:pl-16 md:pl-16 sm:pl-16";
      }
    },
  },
};
</script>

<script>
import { mapMutations } from "vuex";

export default {
  components: {},
  props: {
    title: {
      type: String,
      default: null,
    },
  },
  data: function () {
    return {};
  },
};
</script>

<style type="text/css">
.modal-close {
  background-color: #bbb;
}
</style>

<template>
  <div class="modal-content modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">{{ title }}</p>
    </header>
    <section class="modal-card-body">
      <iframe
        src="https://docs.google.com/forms/d/e/1FAIpQLSe09RVwB6SKDHVDMhOKnmS71dvM6imGY6CCL7gxITsYDiRopw/viewform?embedded=true"
        width="100%"
        frameborder="0"
        marginheight="0"
        marginwidth="0"
        >Carregando…</iframe
      >
    </section>
  </div>
</template>
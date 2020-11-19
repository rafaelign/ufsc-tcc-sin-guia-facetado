<script>
import ClipLoader from "vue-spinner/src/ClipLoader";
import ShareButtons from "./ShareButtons";
import ModalGoogleForm from "./ModalGoogleForm";

export default {
  components: {
    ModalGoogleForm,
    ClipLoader,
    ShareButtons,
  },
  data: function () {
    return {
      isComponentModalGoogleActive: false,
      entities: [],
      errors: [],
      isLoadingMenu: false,
    };
  },
  created() {
    this.isLoadingMenu = true;

    axios
      .get(this.$store.getters.getUrl + "/api/classifications")
      .then((response) => {
        this.entities = response.data;
        this.isLoadingMenu = false;
      })
      .catch((error) => (this.errors = error.response.data.errors));
  },
};
</script>

<template>
  <aside
    class="column is-4 is-4-tablet is-3-desktop is-3-widescreen is-2-fullhd is-fullheight is-narrow-mobile"
  >
    <div class="has-text-centered-mobile">
      <figure class="image">
        <img
          :src="$root.url + '/images/logo.png'"
          alt="Logo"
          style="max-width: 300px"
        />
      </figure>
    </div>
    <ul class="menu-list">
      <li>
        <router-link to="/app"> Sobre este guia </router-link>
      </li>

      <li v-for="(item, key) in entities">
        <router-link :to="{ path: '/app/classificacoes/' + item.slug }">
          {{ item.title }}
        </router-link>

        <ul>
          <li>
            <router-link
              :to="{ path: '/app/classificacoes/' + item.slug + '/entidades' }"
            >
              <b-icon icon="view-list" size="is-small"></b-icon>
              <span>{{ item.main_menu }}</span>
            </router-link>
          </li>
          <li>
            <router-link
              :to="{ path: '/app/classificacoes/' + item.slug + '/facetas' }"
            >
              <b-icon icon="information" size="is-small"></b-icon>
              <span>Facetas de Classificação</span>
            </router-link>
          </li>
        </ul>
      </li>
      <li>
        <router-link to="/app/abordagens">
          Abordagens de elicitação de requisitos
        </router-link>
      </li>
      <li class="is-hidden-tablet">
        <router-link to="#">Compartilhe</router-link>

        <share-buttons></share-buttons>
      </li>

      <li>
        <router-link to="/app/publicacoes"> Publicações </router-link>
      </li>
    </ul>
    <clip-loader v-if="isLoadingMenu" class="is-centered"></clip-loader>

    <nav
      class="navbar is-fixed-bottom socialbar is-hidden-mobile"
      style="opacity: unset"
    >
      <div class="navbar-item">
        <share-buttons label="Compartilhe"></share-buttons>
      </div>
    </nav>

    <div>
      <b-modal
        :active.sync="isComponentModalGoogleActive"
        class="modal modal-full-screen modal-fx-fadeInScale"
        width="100%"
      >
        <modal-google-form
          title="Gostaríamos de saber o que você achou do Guia REtraining."
        ></modal-google-form>
      </b-modal>
      <button
        class="button is-primary is-medium"
        style="
          display: inline-block;
          text-decoration: none;
          background-color: #3a7685;
          color: white;
          cursor: pointer;
          font-family: Helvetica, Arial, sans-serif;
          font-size: 20px;
          line-height: 50px;
          text-align: center;
          margin: 0;
          height: 50px;
          padding: 0px 33px;
          border-radius: 25px;
          max-width: 100%;
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
          font-weight: bold;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
          position: fixed;
          box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.06),
            0px 2px 4px rgba(0, 0, 0, 0.08);
          right: 26px;
          bottom: 26px;
          z-index: 39;
        "
        @click="isComponentModalGoogleActive = true"
      >
        <b-icon icon="comment-quote"></b-icon> <span>Feedback</span>
      </button>
    </div>
  </aside>
</template>
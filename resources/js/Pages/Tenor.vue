<template>
  <v-container>
    <v-row class="my-10" align="center" justify="center">
      <v-col cols="12" shaped>
        <c-text-field name="search" clearable v-model="search" label="search" />
        <v-card width="100%" color="transparent">
          <v-card-text class="pa-8">
            <v-row>
              <v-col
                v-for="gif in tenorData"
                :key="gif.id"
                cols="12"
                sm="6"
                md="4"
              >
                <v-card
                  height="360"
                  shaped
                  link
                  class="d-flex flex-column pb-3"
                >
                  <v-img
                    @click.prevent="switchImage(gif)"
                    :src="gif.media.thumbnail_url"
                    :ref="gif.id"
                    width="100%"
                    height="200px"
                  />

                  <v-card-actions
                    class="d-flex flex-column"
                    style="height: 100px"
                  >
                    <v-card-title class="cardAction">{{
                      gif.title
                    }}</v-card-title>

                    <a
                      class="v-btn cardAction mt-1 v-btn--flat v-btn--text"
                      :href="gif.short_url"
                      target="_blank"
                      style="font-size: 12px !important"
                    >
                      see this image on tenor
                    </a>
                  </v-card-actions>
                </v-card>
              </v-col>
            </v-row>
          </v-card-text>
          <v-card-actions
            class="primary white--text justify-center pa-5"
            @click="loadMore"
            v-if="!search"
            style="cursor: pointer"
          >
            <v-btn text :loading="loading" class="white--text">
              Load More
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import AppLayout from "@/Layouts/Layout";
import { debounce } from "lodash/function";
export default {
  layout: AppLayout,
  props: ["tenor"],
  metaInfo() {
    return {
      title: this.pageTitle,
    };
  },
  watch: {
    search: {
      handler: debounce(function () {
        this.searchData();
      }, 1000),
      deep: true,
    },
  },

  data() {
    return {
      pageTitle: "AcmeGif Tenor",

      tenorData: this.tenor.data,
      next: this.tenor.next,
      loading: false,
      search: "",
    };
  },
  methods: {
    switchImage(gif) {
      this.$refs[gif.id][0].src = gif.media.image_url;
    },

    async loadMore(next = null) {
      this.loading = true;
      let nextPage = next == null ? "" : this.next;
      await axios.get("/tenor?pos=" + nextPage).then((res) => {
        this.loading = false;

        this.tenorData.push(...res.data.data);
        this.next = res.data.next;
      });
    },
    async searchData() {
      if (this.search) {
        await axios.get("/tenor/search?q=" + this.search).then((res) => {
          this.loading = false;

          this.tenorData = res.data.data;
          this.next = res.data.next;
        });
      } else {
        this.tenorData = [];
        this.loadMore(null);
      }
    },
  },
};
</script>

<style>
.cardAction {
  text-align: left;
  font-size: 0.9rem !important;
}
</style>

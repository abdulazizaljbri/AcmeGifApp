<template>
  <v-container>
    <v-row class="my-10" align="center" justify="center">


    <v-col cols="12" shaped v-if="tenor">
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
          <v-card-actions class="primary white--text justify-center pa-5">
            <c-inertia-link :href="route('tenor')" class=" white--text" method="get" >
                See More
            </c-inertia-link>

          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import AppLayout from "@/Layouts/Layout";
export default {
  layout: AppLayout,
  props: [ "tenor"],
  metaInfo() {
    return {
      title: this.pageTitle,
    };
  },

  data() {
    return {
      pageTitle: "AcmeGif Tenor",

      tenorData: this.tenor,
    };
  },
  methods: {
    switchImage(gif) {
      this.$refs[gif.id][0].src = gif.media.image_url;


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

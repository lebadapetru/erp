<template>
  <div class="container">
    <template
      v-for="(file, index) in files"
      :key="file.file['@id']"
    >
      <div class="file-wrapper">
        <button>
          <div class="file-overlay">
            <i class="fas fa-expand-alt fa-lg fa-inverse"></i>
          </div>
          <div class="file-preview">
            <img
              :src="thumbnail(file.file.url)"
              alt=""
            />
          </div>
          <div class="file-select" :class="{'opacity-100': selectedFiles.length > 0}">
            <div class="form-check form-check-sm form-check-custom form-check-solid">
              <input
                type="checkbox"
                class="form-check-input widget-9-check"
                :name="`file-${index}`"
                :value="index"
                v-model="selectedFiles"
              />
            </div>
          </div>
        </button>
      </div>
    </template>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType, ref, watch } from "vue";
import { ProductFile } from "resources/ts/types";
import { thumbnail } from "resources/ts/helpers";
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox.vue";

export default defineComponent({
  name: "VFileGallery",
  components: { VBaseCheckbox },
  props: {
    modelValue: {
      type: Array as PropType<ProductFile[]>,
      default: []
    },
  },
  setup: (props) => {
    const files = ref([])
    const selectedFiles = ref([])

    watch(() => props.modelValue, items => {
      files.value = []
      items.forEach(item => {
        files.value.push(item)
      })

    })

    return {
      files,
      thumbnail,
      selectedFiles,
    }
  }
})
</script>

<style scoped>
/*TODO move this in its own file*/
.container {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  grid-gap: 0.8rem;
  -webkit-user-select: none;
  user-select: none;
}

.file-wrapper:first-child {
  grid-column: 1/span 2;
  grid-row: 1/span 2;
}

.file-wrapper > button {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  margin: 0;
  padding: 0;
  border: 1px solid rgba(201, 204, 207, 1);
  background: rgba(255, 255, 255, 1);
  border-radius: 6px;
}

div.file-wrapper > button > div.file-select {
  position: absolute;
  z-index: 12;
  top: 0.8rem;
  left: 0.8rem;
  opacity: 0;
  transition: opacity .1s cubic-bezier(0, 0, .42, 1);
}

div.file-wrapper > button > div.file-overlay {
  position: absolute;
  z-index: 11;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  display: flex;
  flex-flow: column nowrap;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  opacity: 0;
  background: linear-gradient(
    180deg, rgba(33, 43, 54, .55), hsla(0, 0%, 100%, 0));
  border-radius: 5px;
  cursor: pointer;
}

div.file-wrapper > button > div.file-overlay:hover,
div.file-wrapper > button > div.file-overlay:hover ~ div.file-select,
div.file-wrapper > button > div.file-select:hover {
  transition: opacity .1s cubic-bezier(0, 0, .42, 1);
  opacity: 1;
}

div.file-wrapper > button > div.file-preview {
  z-index: 5;
  display: flex;
  overflow: hidden;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100%;
  border-radius: 5px;
  transform: translateZ(0);
}

div.file-wrapper > button > div.file-preview::after {
  content: "";
  display: block;
  width: 100%;
  padding-bottom: 100%;
}

div.file-wrapper > button > div.file-preview > img {
  position: absolute;
  z-index: 1;
  max-width: 100%;
  min-width: 100%;
  max-height: 100%;
}

div.file-select > div.form-check-custom > input {
  border: 2px solid rgba(140, 145, 150, 1);
  background-color: rgba(255, 255, 255, 1);
  border-radius: 0.45rem;
}

div.file-select > div.form-check-custom > input:checked {
  border: 2px solid #009EF7;
}

</style>
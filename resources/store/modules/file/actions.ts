import { deleteFile } from "resources/js/api/File";

const actions = {
  delete: ({ state, commit }, id) => {
    return deleteFile(id)
  }
}

export default actions
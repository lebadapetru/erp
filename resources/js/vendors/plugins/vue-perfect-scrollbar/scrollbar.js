import PerfectScrollbar from 'perfect-scrollbar'
import { isEmpty } from 'lodash'
import {
  onMounted,
  onUpdated,
  onBeforeUnmount,
  reactive,
  ref,
  nextTick,
  h,
} from 'vue'

const eventNames = [
  'scroll',
  'ps-scroll-y',
  'ps-scroll-x',
  'ps-scroll-up',
  'ps-scroll-down',
  'ps-scroll-left',
  'ps-scroll-right',
  'ps-y-reach-start',
  'ps-y-reach-end',
  'ps-x-reach-start',
  'ps-x-reach-end'
]

export default {
  name: 'VuePerfectScrollbar',
  props: {
    options: {
      type: Object,
      required: false,
      default: () => {
      }
    },
    tag: {
      type: String,
      required: false,
      default: 'div'
    },
    watchOptions: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  emits: eventNames,
  setup(props, {emit, slots}) {
    const el = ref(null)
    let ps = null

    onMounted(() => {
      nextTick().then(() => {
        create()
      })
    })

    onUpdated(() => {
      nextTick().then(() => {
        update()
      })
    })

    onBeforeUnmount(() => {
      destroy()
    })

    function create() {
      if (isEmpty(ps)) {
        ps = reactive(new PerfectScrollbar(el.value, props.options))
        eventNames.forEach(eventName => {
          ps.element.addEventListener(eventName, event => emit(eventName, event))
        })
      }
    }

    function update() {
      if (!isEmpty(ps)) {
        ps.update()
      }
    }

    function destroy() {
      if (!isEmpty(ps)) {
        ps.destroy()
        ps = null
      }
    }

    return () => h(
      props.tag,
      {
        class: 'ps',
        ref: el
      },
      slots.default && slots.default()
    )
  },
}
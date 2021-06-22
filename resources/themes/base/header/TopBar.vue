<template>
  <!--begin::Toolbar wrapper-->
  <div class="d-flex align-items-stretch flex-shrink-0">
    <!--begin::Activities-->
    <div class="d-flex align-items-center ms-1 ms-lg-3">
      <!--begin::drawer toggle-->
      <div
        class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
        id="kt_activities_toggle"
      >
        <span class="svg-icon svg-icon-1">
          <svg version="1.1" viewBox="0 0 24 24" height="24px" width="24px" xmlns="http://www.w3.org/2000/svg">
    <path xmlns="http://www.w3.org/2000/svg" d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" id="Combined-Shape" fill="#000000"></path>
    <path xmlns="http://www.w3.org/2000/svg" d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
</svg>
        </span>
      </div>
      <!--end::drawer toggle-->
    </div>
    <!--end::Activities-->

    <!--begin::Quick links-->
    <div class="d-flex align-items-center ms-1 ms-lg-3">
      <!--begin::Menu-->
      <div
        class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
      >
        <span class="svg-icon svg-icon-1">
          <inline-svg src="build/media/icons/duotone/Layout/Layout-4-blocks.svg" />
        </span>
      </div>
      <QuickLinksMenu />
      <!--end::Menu-->
    </div>
    <!--end::Quick links-->

    <!--begin::Chat-->
    <div class="d-flex align-items-center ms-1 ms-lg-3">
      <!--begin::Menu wrapper-->
      <div
        class="btn btn-icon btn-active-light-primary position-relative w-30px h-30px w-md-40px h-md-40px"
        id="kt_drawer_chat_toggle"
      >
        <span class="svg-icon svg-icon-1">
          <inline-svg src="build/media/icons/duotone/Communication/Group-chat.svg" />
        </span>

        <span
          class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"
        >
        </span>
      </div>
      <!--end::Menu wrapper-->
    </div>
    <!--end::Chat-->

    <!--begin::Notifications-->
    <div class="d-flex align-items-center ms-1 ms-lg-3">
      <!--begin::Menu-->
      <div
        class="btn btn-icon btn-active-light-primary position-relative w-30px h-30px w-md-40px h-md-40px"
      >
        <span class="svg-icon svg-icon-1">
          <inline-svg src="build/media/icons/duotone/Code/Compiling.svg" />
        </span>
      </div>
      <NotificationsMenu />
      <!--end::Menu-->
    </div>
    <!--end::Notifications-->

    <!--begin::User-->
    <div
      class="d-flex align-items-center ms-1 ms-lg-3"
      id="kt_header_user_menu_toggle"
    >
      <!--begin::Menu-->
      <div
        class="cursor-pointer symbol symbol-30px symbol-md-40px"
      >
        <img src="build/media//avatars/150-2.jpg" alt="metronic" />
      </div>
      <UserMenu />
      <!--end::Menu-->
    </div>
    <!--end::User -->

    <!--begin::Heaeder menu toggle-->
    <div
      class="d-flex align-items-center d-lg-none ms-2 me-n3"
      title="Show header menu"
    >
      <div
        class="btn btn-icon btn-active-light-primary"
        id="kt_header_menu_mobile_toggle"
      >
        <span class="svg-icon svg-icon-1">
          <inline-svg src="build/media/icons/duotone/Text/Toggle-Right.svg" />
        </span>
      </div>
    </div>
    <!--end::Heaeder menu toggle-->
  </div>
  <!--end::Toolbar wrapper-->
</template>

<script>
import InlineSvg from "vue-inline-svg";
import NotificationsMenu from "resources/themes/base/header/partials/NotificationsMenu";
import QuickLinksMenu from "resources/themes/base/header/partials/QuickLinksMenu";
import UserMenu from "resources/themes/base/header/partials/UserMenu";

export default {
  name: "TopBar",
  components: {
    NotificationsMenu,
    QuickLinksMenu,
    UserMenu,
    InlineSvg,
  },
}
</script>

<style scoped>

</style>
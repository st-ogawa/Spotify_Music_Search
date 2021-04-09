<template>
  <div id="modal">
      <transition name="modal"  appear>
        <div class="modal-mask" @click="$emit('close')">
          <div class="modal-wrapper">
            <div class="modal-container">
              <div class="modal-close">
                <button class="modal-default-button" @click="$emit('close')">
                    <i class="fas fa-times-circle fa-lg" @click="$emit('close')"></i>
                </button>
              </div>
              <div class="modal-body">
                <slot name="body">
                </slot>
              </div>
            </div>
          </div>
        </div>
      </transition>
  </div>
</template>

<style>
.modal-mask {
  position: fixed;
  z-index: 900;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
  cursor: pointer;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}


.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
  border: none;
  outline: none;
  cursor: pointer;
}

.modal-enter-active, .v-leave-active {
  transition: all 0.5s
}

.modal-enter {
  transform: translateY(-10px);
}
.modal-leave {
  transform:  translateY(10px);
}
.modal-enter, .modal-leave-to {
  opacity: 0
}

</style>
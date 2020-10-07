<template>
  <div class="copyBtn-wrap">
    <button @click="writeToClipboard(url)">
      URLをコピー
    </button>
  </div>
</template>

<script>
export default {
  props: {
    postUrl: {
      type: String,
    },
  },
  data() {
    return {
      url: this.postUrl,
    }
  },
  methods: {
    writeToClipboard(text) {
      navigator.clipboard.writeText(text)
      .then(() => {
        alert('URLをコピーしました！');
      })
      .catch((e) => {
        alert(e);
      })
    }
  }
}
</script>

<style lang="css"　scoped>
  button {
    background-color: #c4302b;
    color: #fff;
    padding: 8px 12px;
    border-radius: 3px;
    -webkit-transition: 0.3s;
    -moz-transition: 0.3s;
    -ms-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 0.3s;
    box-shadow: 0 2px 10px;
    font-size: 1.2rem;
  }

  .button:hover {
    box-shadow: 1px 6px 15px;
  }
</style>

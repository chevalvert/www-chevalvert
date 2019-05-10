panel.plugin('arnaudjuracek/kirby-preview-vimeo', {
  fields: {
    vimeo: {
      props: {
        id: String,
        url: String
      },
      template: `
      <k-view class="kirby-preview-vimeo">
        <iframe :src=url frameborder="0" class="kirby-preview-vimeo__iframe"></iframe>
      </k-view>`
    }
  }
});

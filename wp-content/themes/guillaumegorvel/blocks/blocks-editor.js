(() => {
    const { registerBlockType } = wp.blocks;
    const { createElement: el } = wp.element;
    const ServerSideRender = wp.serverSideRender;

    const blocks = window.GG_BLOCKS || [];

    blocks.forEach((meta) => {
        registerBlockType(meta.name, {
            title: meta.title,
            category: meta.category,
            icon: meta.icon,
            description: meta.description,
            keywords: meta.keywords,
            supports: meta.supports,
            edit: (props) => el(ServerSideRender, { block: meta.name, attributes: props.attributes }),
            save: () => null
        });
    });
})();
const Gallery = ({ images = [] }) => {
  return (
    <section id="gallery" className="py-20 bg-gray-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <h2 className="text-4xl font-bold text-gray-800 mb-4">Gallery</h2>
          <div className="w-16 h-1 bg-green-500 mx-auto"></div>
        </div>

        {images.length > 0 ? (
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            {images.map((image, index) => (
              <div key={index} className="relative group overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <img 
                  src={image.src} 
                  alt={image.alt || `Gallery image ${index + 1}`}
                  className="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300"
                />
                {image.caption && (
                  <div className="absolute bottom-0 left-0 right-0 bg-black bg-opacity-75 text-white p-4 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                    <p className="text-sm">{image.caption}</p>
                  </div>
                )}
              </div>
            ))}
          </div>
        ) : (
          <div className="text-center">
            <div className="bg-gray-200 border-2 border-dashed border-gray-400 rounded-lg p-12">
              <p className="text-gray-500 text-lg">Your images will appear here</p>
              <p className="text-gray-400 text-sm mt-2">Add images to see them displayed in the gallery</p>
            </div>
          </div>
        )}
      </div>
    </section>
  )
}

export default Gallery




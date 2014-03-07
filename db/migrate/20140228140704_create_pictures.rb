class  CreatePictures < ActiveRecord::Migration
  def up
    create_table :pictures do |t|
      t.string :name

      t.integer :album_id
      t.binary :content, size: (1024 * 1024 * 1024)
      
      t.datetime :created
      t.datetime :modified
    end
  end

  def down
    drop_table :pictures
  end
end